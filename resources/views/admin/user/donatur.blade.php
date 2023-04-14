@extends('layouts.admin.admin')
@section('title', 'Management User')
@section('toolbar')
    @php
        $items = [];
    @endphp
    <x-toolbar :title="'Fundriser '.$user->name.' : Donatur Handle'" :items="$items"></x-toolbar>
@endsection
@section('content')
<div class="content flex-row-fluid" id="kt_content">
    <div class="card">
        <div class="card-body py-4">
            <x-message></x-message>
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">ID</th>
                        <th class="min-w-125px">Label</th>
                        <th class="min-w-125px">Nama</th>
                        <th class="min-w-125px">Email</th>
                        <th class="min-w-125px">Alamat</th>
                        <th class="min-w-125px">No. telp</th>
                        <th class="min-w-125px">Respon</th>
                        <th class="min-w-125px">Last Chat</th>
                        <th class="min-w-125px">Catatan</th>
                        <th class="min-w-125px">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
        let table = $('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:'{!! route('donatur.data') !!}',
            method:'GET',
            data:{user_id:@json($user->id)}
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'label_id', name: 'label_id' },
            { data: 'nama', name: 'nama' },
            { data: 'email', name: 'email' },
            { data: 'alamat', name: 'alamat' },
            { data: 'no_telp', name: 'no_telp' },
            { data: 'respon', name: 'respon' },
            { data: 'terakhir_chat', name: 'terakhir_chat' },
            { data: 'catatan', name: 'catatan' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>
@endsection