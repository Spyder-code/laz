<?php

namespace App\Repositories;

use App\Models\Donatur;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UserService extends Repository
{

    public function __construct()
    {
        $this->model = new User;
    }

    public function update(array $data, $id)
    {
        if($data['password']!=null) {
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }
        $this->model->find($id)->update($data);
    }

    public function store(array $data)
    {
        if($data['password']!=null) {
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }
        $this->model->create($data);
    }

    public function addDonatur(array $data, $id)
    {
        Donatur::whereIn('id',$data['donatur_id'])->update([
            'user_id' => $id
        ]);
    }

    public function dataTable()
    {
        return DataTables::of($this->model->all()->sortByDesc('created_at'))
            ->addColumn('role_id', function ($data) {
                return $data->role->name;
            })
            ->addColumn('created_at', function($data){
                return date('d/m/Y H:i',strtotime($data->created_at));
            })
            ->addColumn('updated_at', function($data){
                return date('d/m/Y H:i',strtotime($data->updated_at));
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('user.edit', $data->id) . '" class="btn btn-primary btn-sm mt-1" style="font-size:.7rem"><i class="fas fa-pen-alt"></i></a>
                        <a href="' . route('user.show', $data->id) . '" class="btn btn-warning btn-sm mt-1" style="font-size:.7rem"><i class="fas fa-users"></i></a>
                        <form action="' . route('user.destroy', $data->id) . '" method="POST" class="d-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <button class="btn btn-danger btn-sm mt-1" style="font-size:.7rem" onclick="return confirm(\'are yous sure?\')"><i class="fas fa-trash-alt"></i></button>
                        </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
