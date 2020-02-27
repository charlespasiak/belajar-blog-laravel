@extends('../../layouts.main')

@section('content-header', 'Tambah Post')

@section('content-body')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Post</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="judul" value="{{old('judul')}}">
        @error('name') 
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Kategori</label>
        <select name="category_id" class="form-control">
            <option value="" holder>Pilih Kategori</option>
            @foreach ($category as $result)     
            <option value="{{ $result->id }}">{{ $result->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Pilih Tags</label>
        <select class="form-control select2" multiple="" name="tags[]">
            @foreach ($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Konten</label>
        <textarea name="content" class="form-control" id="content"></textarea>
    </div>
    <div class="form-group">
        <label>Thumbnail</label>
        <input type="file" name="gambar" class="form-control">
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block">Simpan Post</button>
    </div>
</form>



@push('ckeditor')
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endpush

@endsection
