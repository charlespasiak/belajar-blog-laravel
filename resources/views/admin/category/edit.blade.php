@extends('../../layouts.main')

@section('content-header', 'Edit Kategori')

@section('content-body')
    
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    
    <form action="{{ route('category.update', $category->id) }}" method="POST">
        @method('patch')
        @csrf
        <div class="form-group">
            <label>Kategori</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$category->name}}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="form-group">
            <button class="btn btn-primary btn-block">Update Kategori</button>
        </div>
    </form>

@endsection