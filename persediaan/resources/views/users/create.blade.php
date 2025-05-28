@extends('layouts.main')

@section('content')
<form action="{{ route('users.store') }}" method="post">
    @csrf

    Nama Users
    @error('name')
        <span class="text-danger">({{ $message }})</span>
    @enderror
    <input type="text" name="name" class="form-control mb-2">
    
    Email 
    @error('email')
        <span class="text-danger">({{ $message }})</span>
    @enderror
    <input type="text" name="email" class="form-control mb-2">
    
    Password
    @error('password')
        <span class="text-danger">({{ $message }})</span>
    @enderror 
    <input type="password" name="password" class="form-control mb-2">

    Role
    @error('level')
        <span class="text-danger">({{ $message }})</span>
    @enderror 
    <select name="level" class="form-control mb-2">
        <option value="">-- Pilih Role --</option>
        <option value="admin">admin</option>
        <option value="pemilik">pemilik</option>
    </select>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>


@endsection