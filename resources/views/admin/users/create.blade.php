@extends('../../layouts.main')

@section('content-header', 'Tambah User')

@section('content-body')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<form action="{{ route('user.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}">
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Tipe User</label>
        <select name="tipe" class="form-control">
            <option value="" holder>Pilih tipe user</option>
            <option value="1" holder>Administrator</option>
            <option value="0" holder>Author</option>
        </select>
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block">Simpan Username</button>
    </div>
</form>
@endsection