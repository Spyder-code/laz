<?php

namespace App\Repositories;

use App\Models\Donatur;
use Yajra\DataTables\DataTables;

class DonaturService extends Repository
{

    public function __construct()
    {
        $this->model = new Donatur;
    }

    public function dataTable()
    {
        if(request('user_id')){
            $data = $this->model->all()->where('user_id',request('user_id'));
        }else{
            $data = $this->model->all();
        }
        return DataTables::of($data)
            ->addColumn('label_id', function($data){
                return '<div class="px-3 py-2" style="border:1px solid '.$data->label->warna.'; color: '.$data->label->warna.'; border-radius:10px;">'.$data->label->nama.'</div>';
            })
            ->addColumn('last_chat', function($data){
                return date('d/m/Y H:i',strtotime($data->trakhir_chat));
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('donatur.edit', $data->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-pen-alt"></i></a>
                        <form action="' . route('donatur.destroy', $data->id) . '" method="POST" class="d-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <button class="btn btn-danger btn-sm" onclick="return confirm(\'are yous sure?\')"><i class="fas fa-trash-alt"></i></button>
                        </form>';
            })
            ->rawColumns(['action','label_id'])
            ->make(true);
    }
}
