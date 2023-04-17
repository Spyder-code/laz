@extends('layouts.admin.admin')
@section('title', 'Management User')
@section('toolbar')
    @php
        $items = [];
        if(Auth::user()->role_id==1){
            $items = ['<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Donatur</button>'];
        }
    @endphp
    <x-toolbar :title="'Fundraiser '.$user->name.' : Donatur Handle'" :items="$items"></x-toolbar>
@endsection
@section('content')
<div class="content flex-row-fluid" id="kt_content">
    <div class="card">
        <div class="card-body py-4">
            <x-message></x-message>
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="donatur">
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

<!-- Button trigger modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ route('user.add.donatur', $user) }}" class="modal-dialog modal-xl" method="POST">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">List Donatur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table table-sm table-bordered" id="donatur-list">
                <thead>
                    <tr>
                        <th style="width: 5px">#</th>
                        <th style="width: 50px">Nama</th>
                        <th style="width: 50px">No. Telp</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donatur as $item)
                    <tr>
                        <td><input type="checkbox" name="donatur_id[]" value="{{ $item->id }}"></td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->no_telp }}</td>
                        <td>{{ Str::limit($item->alamat, 50, '...') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" onclick="return confirm('are you sure?')" class="btn btn-primary">Add Donatur To Fundraiser</button>
        </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    $('#donatur-list').DataTable()
    let table = $('#donatur').DataTable({
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
