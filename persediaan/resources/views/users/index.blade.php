@extends('layouts.main')

@section('content')
<h4>Manajemen Users</h4>
<a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah User</a>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
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
                <td>{{ $row->role }}</td>
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