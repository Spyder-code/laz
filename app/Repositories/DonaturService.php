<?php

namespace App\Repositories;

use App\Models\Donatur;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DonaturService extends Repository
{

    public function __construct()
    {
        $this->model = new Donatur;
    }

    public function getAvailable()
    {
        $data = $this->model->whereNull('user_id')->get();
        return $data;
    }

    public function pullUser($id)
    {
        $this->model::find($id)->update([
            'user_id' => null
        ]);
    }

    public function dataTable()
    {
        if(request('user_id')){
            $data = $this->model->query()->leftJoin('users','users.id','=','donatur.user_id')->where('donatur.user_id',request('user_id'))->select('donatur.*');
        }elseif(request('type')=='user_id_null'){
            $data = $this->model->query()->leftJoin('users','users.id','=','donatur.user_id')->whereNull('donatur.user_id')->select('donatur.*');
        }elseif(request('type')=='user_id_not_null'){
            $data = $this->model->query()->leftJoin('users','users.id','=','donatur.user_id')->whereNotNull('donatur.user_id')->select('donatur.*');
        }else{
            $data = $this->model->query()->leftJoin('users','users.id','=','donatur.user_id')->select('donatur.*');
        }
        return DataTables::of($data)
            ->addColumn('label_id', function($data){
                return '<div class="px-3 py-2" style="border:1px solid '.$data->label->warna.'; color: '.$data->label->warna.'; border-radius:10px;">'.$data->label->nama.'</div>';
            })
            ->addColumn('last_chat', function($data){
                return date('d/m/Y H:i',strtotime($data->trakhir_chat));
            })
            ->addColumn('fundraiser', function($data){
                return $data->user->name ?? '-';
            })
            ->addColumn('action', function ($data) {
                if (Auth::user()->role_id==1) {
                    return '<a href="' . route('donatur.edit', $data->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-pen-alt"></i></a>
                            <form action="' . route('donatur.destroy', $data->id) . '" method="POST" class="d-inline">
                                <input type="hidden" name="user_id" value="'.request('user_id').'">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button class="btn btn-danger btn-sm" onclick="return confirm(\'are yous sure?\')"><i class="fas fa-trash-alt"></i></button>
                            </form>';
                }else{
                    return '<a href="' . route('donatur.edit', $data->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-pen-alt"></i></a>';
                }
            })
            ->rawColumns(['action','label_id'])
            ->make(true);
    }
}
