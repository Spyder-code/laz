@extends('layouts.admin.admin')
@section('toolbar')
    <x-toolbar :title="'Create Donatur'"></x-toolbar>
@endsection
@section('content')
<div class="content flex-row-fluid" id="kt_content">
    <div class="card">
        <div class="card-body py-2">
            <form method="POST" class="form" novalidate action="{{ route('donatur.store') }}">
                @csrf
                <div class="row">
                    @include('admin.donatur.form')
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('donatur.index') }}" data-theme="light" class="btn btn-bg-secondary btn-active-color-primary">Back</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection