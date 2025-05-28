{{-- copy dari create.blade.php fakultas --}}
@extends('layouts.main')

@section('content')
    <h4>Edit Data Users</h4>
    <form action="{{ route('users.update', $user['id'])}}" method="post">
    @csrf
    @method('PUT') 
    
    Nama Users
    @error('name')
        <span class="text-danger">({{ $message }})</span>
    @enderror
    <input type="text" name="name" id="" class="form-control mb-2" value="{{ $user['name']}}">
    
    Email
    @error('email')
        <span class="text-danger">({{ $message }})</span>
    @enderror 
    <input type="text" name="email" id="" class="form-control mb-2" value="{{ $user['email']}}">

    Password
    @error('password')
        <span class="text-danger">({{ $message }})</span>
    @enderror 
    <input type="number" name="password" id="" class="form-control mb-2" value="{{ $user['password']}}">

     Role
    @error('level')
        <span class="text-danger">({{ $message }})</span>
    @enderror 
    <select name="role" class="form-control mb-2">
        <option value="">-- Pilih Role --</option>
        <option value="admin" {{ $user['level'] == 'admin' ? 'selected' : '' }}>admin</option>
        <option value="pemilik" {{ $user['level'] == 'pemilik' ? 'selected' : '' }}>pemilik</option>
    </select>

    <button type="submit" class="btn btn-primary">SIMPAN</button>
    </form>
@endsection