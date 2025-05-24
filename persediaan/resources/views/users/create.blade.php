@extends('layouts.main')

@section('content')
<form action="{{ route('users.store') }}" method="post">
    @csrf

    Nama Users
    @error('name')
        <span class="text-danger">({{ $message }})</span>
    @enderror
    <input type="text" name="name" id="" class="form-control mb-2">
    
    Email 
    @error('email')
        <span class="text-danger">({{ $message }})</span>
    @enderror
    <input type="text" name="email" id="" class="form-control mb-2">
    
    Password
    @error('password')
        <span class="text-danger">({{ $message }})</span>
    @enderror 
    <input type="number" name="password" id="" class="form-control mb-2">

    Role
    @error('role')
        <span class="text-danger">({{ $message }})</span>
    @enderror 
    <select name="role" class="form-control mb-2">
        <option value="">-- Pilih Role --</option>
        <option value="admin">admin</option>
        <option value="pemilik">pemilik</option>
    </select>

    <button type="submit" class="btn btn-primary">Simpan</button>

@endsection