<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Repositories\LabelService;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    private $labelService;

    public function __construct(LabelService $labelService)
    {
        $this->labelService = $labelService;
    }


    public function index()
    {
        $data = $this->labelService->all();
        return view('admin.label.index', compact('data'));
    }


    public function create()
    {
        return view('admin.label.create');
    }


    public function store(Request $request)
    {
        $this->labelService->store($request->all());
        return redirect()->route('label.index')->with('success','Label has success created');
    }


    public function show(Label $label)
    {
        return view('admin.label.show', compact('label'));
    }


    public function edit(Label $label)
    {
        return view('admin.label.edit', compact('label'));
    }


    public function update(Request $request, Label $label)
    {
        $this->labelService->update($request->all(),$label->id);
        return redirect()->route('label.index')->with('success','Label has success updated');
    }


    public function destroy(Label $label)
    {
        $this->labelService->destroy($label->id);
        return redirect()->route('label.index')->with('success','Label has success deleted');
    }

    public function dataTable()
    {
        return $this->labelService->dataTable();
    }
}