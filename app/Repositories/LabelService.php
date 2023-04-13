<?php

namespace App\Repositories;

use App\Models\Label;
use Yajra\DataTables\DataTables;

class LabelService extends Repository
{

    public function __construct()
    {
        $this->model = new Label;
    }

    public function dataTable()
    {
        return DataTables::of($this->model->all())
            ->addColumn('warna', function($data){
                return '<div style="height:40px; width:60px; background-color:'.$data->warna.'"></div>';
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('label.edit', $data->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-pen-alt"></i></a>
                        <form action="' . route('label.destroy', $data->id) . '" method="POST" class="d-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <button class="btn btn-danger btn-sm" onclick="return confirm(\'are yous sure?\')"><i class="fas fa-trash-alt"></i></button>
                        </form>';
            })
            ->rawColumns(['action','warna'])
            ->make(true);
    }
}
