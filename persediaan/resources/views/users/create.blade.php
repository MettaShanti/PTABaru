@extends('layouts.main')

@section('content')
<form action="{{ route('users.store') }}" method="post">
    @csrf

    <h4>Tambah Data Users</h4>

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="level" class="form-control" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="pemilik">Pemilik</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>


@endsection