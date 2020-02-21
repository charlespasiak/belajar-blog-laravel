@extends('../../layouts.main')

@section('content-header', 'Tambah Kategori')

@section('content-body')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<form action="{{ route('category.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Kategori</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
        @error('name') 
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block">Simpan Kategori</button>
    </div>
</form>
@endsection