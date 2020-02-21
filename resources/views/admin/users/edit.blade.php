@extends('../../layouts.main')

@section('content-header', 'Edit User')

@section('content-body')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<form action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('patch')
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="text" class="form-control @error('password') is-invalid @enderror" name="password"
            value="">
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{$user->email}}" readonly>
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Tipe User</label>
        <select name="tipe" class="form-control">
            <option value="" holder>Pilih tipe user</option>
            <option value="1" holder 
            @if ($user->tipe === 1)
                selected
            @endif
            >Administrator</option>
            <option value="0" holder
            @if ($user->tipe === 0)
                selected
            @endif
            >Author</option>
        </select>
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block">Update Username</button>
    </div>
</form>
@endsection