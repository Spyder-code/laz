@extends('layouts.admin.admin')
@section('toolbar')
    <x-toolbar :title="'Edit User'"></x-toolbar>
@endsection
@section('content')
<div class="content flex-row-fluid" id="kt_content">
    <div class="card">
        <div class="card-body py-2">
            <form method="POST" class="form" novalidate action="{{ route('user.update', $user) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    @include('admin.user.form',['user'=>$user])
                </div>
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('user.index') }}" data-theme="light" class="btn btn-bg-secondary btn-active-color-primary">Back</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
