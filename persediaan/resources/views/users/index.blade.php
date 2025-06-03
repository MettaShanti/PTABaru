@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Manajemen Users</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah User</a>
</div>
<div class="table-responsive">
    <table id="example" class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nama User</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $row)
            <tr>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->level }}</td>
                <td>
                    <a href="{{ route('users.edit', $row->id) }}" class="btn btn-xs btn-warning">UBAH</a>
                    <form action="{{ route('users.destroy', $row->id) }}" method="post" style="display:inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-xs btn-danger" onclick="return confirm('Yakin ingin hapus data ini?')">HAPUS</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection