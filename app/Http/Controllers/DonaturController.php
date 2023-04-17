<?php

namespace App\Http\Controllers;

use App\Imports\DonaturImport;
use App\Models\Donatur;
use App\Repositories\DonaturService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DonaturController extends Controller
{
    private $donaturService;

    public function __construct(DonaturService $donaturService)
    {
        $this->donaturService = $donaturService;
    }


    public function index()
    {
        $data = $this->donaturService->all();
        return view('admin.donatur.index', compact('data'));
    }


    public function create()
    {
        return view('admin.donatur.create');
    }


    public function store(Request $request)
    {
        $this->donaturService->store($request->all());
        return redirect()->route('donatur.index')->with('success','Donatur has success created');
    }


    public function show(Donatur $donatur)
    {
        return view('admin.donatur.show', compact('donatur'));
    }


    public function edit(Donatur $donatur)
    {
        return view('admin.donatur.edit', compact('donatur'));
    }


    public function update(Request $request, Donatur $donatur)
    {
        $this->donaturService->update($request->all(),$donatur->id);
        return redirect()->route('donatur.index')->with('success','Donatur has success updated');
    }


    public function destroy(Donatur $donatur)
    {
        if(request('user_id')&&is_numeric(request('user_id'))){
            $this->donaturService->pullUser($donatur->id);
        }else{
            $this->donaturService->destroy($donatur->id);
        }
        return back()->with('success','Donatur has success deleted');
    }

    public function export(Request $request)
    {
        Excel::import(new DonaturImport, $request->file);

        return back()->with('success', 'Import Success!');
    }

    public function dataTable()
    {
        return $this->donaturService->dataTable();
    }
}
