<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CRUD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:model {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private $repository;
    public function __construct(CreateRepositories $repository)
    {
        $this->repository = $repository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $model_name = $this->argument('name');
        $data = array();
        $j = 1;
        for ($i=0; $i < $j; $i++) {
            $std = $this->ask('name atrribure? (input exit to cancel or execute to generate)');
            if($std=='cancel'){
                $this->info('The command was cancel!');
                break;
            }

            if($std!='cancel' && $std!='execute'){
                $tipe = $this->ask('tipe data? (integer, string, text, boolean, date, dateTime, foreign:table)');
                $input = $this->ask('input tipe? (text, number, textarea, file, date, password, select)');
                $arr = explode(':',$tipe);
                $data[] = (object) array('attr' => $std, 'tipe' => $arr, 'input'=>$input);
                $j++;
            }

            if($std=='execute'){
                $this->createModel($data,$model_name);
                $this->createMigration($data,$model_name);
                Artisan::call('repo:model', ['name' => $model_name ]);
                Artisan::call('controller:model', ['name' => $model_name ]);
                $resource = "Route::resource('".strtolower($model_name)."',App\\Http\\Controllers\\".$model_name."Controller::class);";
                $datatable = "Route::get('data-".strtolower($model_name)."',[App\\Http\\Controllers\\".$model_name."Controller::class,'dataTable'])->name('".strtolower($model_name).".data');";
                $fp = fopen(base_path('routes/web.php'), 'a');
                $fd = fopen(base_path('routes/datatable.php'), 'a');
                fwrite($fp, $resource);
                fwrite($fd, $datatable);
                // $menu = "<li class=\"sidebar-item\">\r\n    <a class=\"sidebar-link waves-effect waves-dark sidebar-link\" href=\"{{ route('".strtolower($model_name).".index') }}\"\r\n        aria-expanded=\"false\">\r\n        <i class=\"fa fa-list\" aria-hidden=\"true\"></i>\r\n        <span class=\"hide-menu\">".$model_name." Management</span>\r\n    </a>\r\n</li>";
                // $fp = fopen(base_path('resources/views/component/sidebar.blade.php'), 'a');
                // fwrite($fp, $menu);
                if (!file_exists(base_path('resources/views/admin'))) {
                    mkdir(base_path('resources/views/admin'), 0777);
                }

                if (!file_exists(base_path('resources/views/admin/'.strtolower($model_name)))) {
                    mkdir(base_path('resources/views/admin/'.strtolower($model_name)), 0777);
                    $this->viewCreate($model_name);
                    $this->viewEdit($model_name);
                    $this->viewIndex($data, $model_name);
                    $this->viewForm($data, $model_name);
                }else{
                    $this->viewCreate($model_name);
                    $this->viewEdit($model_name);
                    $this->viewIndex($data, $model_name);
                    $this->viewForm($data, $model_name);
                }

                $migrate = $this->ask('are you want to migtare database?');
                if ($migrate=='yes') {
                    Artisan::call('migrate');
                }else{
                    $this->info('The command was successful!');
                }
                break;
            }
        }

    }

    public function createModel(array $data, $model_name)
    {
        $str = '';
        foreach ($data as $item) {
            $str = $str."\r\n        '".$item->attr."',";
        };
        $data = "[".$str."\r\n    ]";
        $html = "<?php\r\n\r\nnamespace App\\Models;\r\n\r\nuse Illuminate\\Database\\Eloquent\\Factories\\HasFactory;\r\nuse Illuminate\\Database\\Eloquent\\Model;\r\n\r\nclass ".$model_name." extends Model\r\n{\r\n    use HasFactory;\r\n\r\n    protected ".'$fillable'." = ".$data.";\r\n}\r\n";
        $fp = fopen(base_path('app')."/"."Models/".$model_name.".php","wb");
        fwrite($fp,$html);
        fclose($fp);
    }

    public function createMigration(array $data, $model_name)
    {
        $str = '';
        foreach ($data as $item) {
            if (count($item->tipe)==1) {
                $str = $str."\r\n            ".'$table->'.$item->tipe[0].'('."'".$item->attr."'".')'.";";
            } else {
                $str = $str."\r\n            ".'$table->foreignId('."'".$item->attr."'".')'."->constrained('".$item->tipe[1]."');";
            }

        };
        $html = "<?php\r\n\r\nuse Illuminate\\Database\\Migrations\\Migration;\r\nuse Illuminate\\Database\\Schema\\Blueprint;\r\nuse Illuminate\\Support\\Facades\\Schema;\r\n\r\nclass Create".$model_name."sTable extends Migration\r\n{\r\n    public function up()\r\n    {\r\n        Schema::create('".strtolower($model_name)."s', function (Blueprint ".'$table'.") {\r\n            ".'$table->id()'.";".$str."\r\n            ".'$table->timestamps()'.";\r\n        });\r\n    }\r\n\r\n    public function down()\r\n    {\r\n        Schema::dropIfExists('".strtolower($model_name)."s');\r\n    }\r\n}";
        $file_name = date('Y_m_d_His').'_create_'.strtolower($model_name).'s_table';
        $fp = fopen(base_path('database')."/"."migrations/".$file_name.".php","wb");
        fwrite($fp,$html);
        fclose($fp);
    }

    public function viewCreate($model_name)
    {
        $content = "@extends('layouts.admin.admin')\r\n@section('toolbar')\r\n    <x-toolbar :title=\"'Create ".$model_name."'\"></x-toolbar>\r\n@endsection\r\n@section('content')\r\n<div class=\"content flex-row-fluid\" id=\"kt_content\">\r\n    <div class=\"card\">\r\n        <div class=\"card-body py-2\">\r\n            <form method=\"POST\" class=\"form\" novalidate action=\"{{ route('".strtolower($model_name).".store') }}\">\r\n                @csrf\r\n                <div class=\"row\">\r\n                    @include('admin.".strtolower($model_name).".form')\r\n                </div>\r\n                <div class=\"d-flex justify-content-end gap-2\">\r\n                    <a href=\"{{ route('".strtolower($model_name).".index') }}\" data-theme=\"light\" class=\"btn btn-bg-secondary btn-active-color-primary\">Back</a>\r\n                    <button type=\"submit\" class=\"btn btn-primary\">\r\n                        <span class=\"indicator-label\">Save</span>\r\n                    </button>\r\n                </div>\r\n            </form>\r\n        </div>\r\n    </div>\r\n</div>\r\n@endsection";

        $create = fopen(base_path('resources/views/admin/'.strtolower($model_name))."/"."create.blade.php","wb");
        fwrite($create, $content);
        fclose($create);
    }

    public function viewEdit($model_name)
    {
        $content = "@extends('layouts.admin.admin')\r\n@section('toolbar')\r\n    <x-toolbar :title=\"'Edit ".$model_name."'\"></x-toolbar>\r\n@endsection\r\n@section('content')\r\n<div class=\"content flex-row-fluid\" id=\"kt_content\">\r\n    <div class=\"card\">\r\n        <div class=\"card-body py-2\">\r\n            <form method=\"POST\" class=\"form\" novalidate action=\"{{ route('".strtolower($model_name).".update', $".strtolower($model_name).") }}\">\r\n                @csrf\r\n                @method('PUT')\r\n                <div class=\"row\">\r\n                    @include('admin.".strtolower($model_name).".form',['".strtolower($model_name)."'=>$".strtolower($model_name)."])\r\n                </div>\r\n                <input type=\"hidden\" name=\"id\" value=\"{{ $".strtolower($model_name)."->id }}\">\r\n                <div class=\"d-flex justify-content-end gap-2\">\r\n                    <a href=\"{{ route('".strtolower($model_name).".index') }}\" data-theme=\"light\" class=\"btn btn-bg-secondary btn-active-color-primary\">Back</a>\r\n                    <button type=\"submit\" class=\"btn btn-primary\">\r\n                        <span class=\"indicator-label\">Save</span>\r\n                    </button>\r\n                </div>\r\n            </form>\r\n        </div>\r\n    </div>\r\n</div>\r\n@endsection";

        $edit = fopen(base_path('resources/views/admin/'.strtolower($model_name))."/edit.blade.php","wb");
        fwrite($edit, $content);
        fclose($edit);
    }

    public function viewIndex(array $data, $model_name)
    {
        $header = '';
        $column = '';
        foreach ($data as $item) {
            $header = $header."                                <th class=\"min-w-125px\">".ucfirst($item->attr)."</th>\r\n";
            $column = $column."\r\n            { data: '".strtolower($item->attr)."', name: '".strtolower($item->attr)."' },";
        };

        $content = "@extends('layouts.admin.admin')\r\n@section('title', 'Management ".$model_name."')\r\n@section('toolbar')\r\n    @php\r\n        ".'$items'." = ['<a href=\"'.route('".strtolower($model_name).".create').'\" data-theme=\"light\" class=\"btn btn-bg-white btn-active-color-primary\">Create</a>'];\r\n    @endphp\r\n    <x-toolbar :title=\"'List ".$model_name."'\" :items=\"".'$items'."\"></x-toolbar>\r\n@endsection\r\n@section('content')\r\n<div class=\"content flex-row-fluid\" id=\"kt_content\">\r\n    <div class=\"card\">\r\n        <div class=\"card-body py-4\">\r\n            <x-message></x-message>\r\n            <table class=\"table align-middle table-row-dashed fs-6 gy-5\">\r\n                <thead>\r\n                    <tr class=\"text-start text-muted fw-bold fs-7 text-uppercase gs-0\">\r\n                        <th class=\"min-w-125px\">ID</th>\r\n".$header."                        <th class=\"min-w-125px\">Action</th>\r\n                   </tr>\r\n                </thead>\r\n            </table>\r\n        </div>\r\n    </div>\r\n</div>\r\n@endsection\r\n\r\n@section('script')\r\n<script>\r\n    let table = $('.table').DataTable({\r\n        processing: true,\r\n        serverSide: true,\r\n        ajax: '{!! route('".strtolower($model_name).".data') !!}',\r\n        columns: [\r\n            { data: 'id', name: 'id' },".$column."\r\n            { data: 'action', name: 'action', orderable: false, searchable: false },\r\n        ],\r\n        dom: 'Bfrtip',\r\n        responsive: true,\r\n        buttons: [\r\n            'copy', 'csv', 'excel', 'pdf', 'print'\r\n        ]\r\n    });\r\n</script>\r\n@endsection";

        $index = fopen(base_path('resources/views/admin/'.strtolower($model_name))."/index.blade.php","wb");
        fwrite($index, $content);
        fclose($index);
    }

    public function viewForm(array $data, $model_name)
    {
        $input = '';
        foreach ($data as $item) {
            $input = $input."\r\n<x-input :value=\"$".strtolower($model_name)."->".$item->attr."??old('".$item->attr."')\" :col=\"6\" :label=\"'".ucfirst($item->attr)."'\" :type=\"'".$item->input."'\" :name=\"'".$item->attr."'\" :required=\"true\"></x-input>";
        };

        $content = "<x-error-validation/>\r\n".$input."";

        $form = fopen(base_path('resources/views/admin/'.strtolower($model_name))."/form.blade.php","wb");
        fwrite($form, $content);
        fclose($form);
    }
    public function viewShow(array $data, $model_name)
    {
        $str = '';
        foreach ($data as $item) {
            $str = $str."                    @include('component.input',['input'=> Form::".$item->input."('".$item->attr."',$".strtolower($model_name)."->".$item->attr.",['class' => 'form-control']),'label'=> Form::label('".$item->attr."', '".$item->attr."')])\r\n";
        };

        $content = "@extends('layouts.admin')\r\n@section('content')\r\n<div class=\"container-fluid\">\r\n    <div class=\"row\">\r\n        <div class=\"col-md-12\">\r\n            <div class=\"white-box\">\r\n                <h3 class=\"box-title\">Detail </h3>                \r\n".$str."               \r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n@endsection";

        $show = fopen(base_path('resources/views/admin/'.strtolower($model_name))."/show.blade.php","wb");
        fwrite($show, $content);
        fclose($show);
    }
}
