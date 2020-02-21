@extends('../../layouts.main')

@section('content-header', 'Edit Post')

@section('content-body')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @method('patch')
    @csrf
    <div class="form-group">
        <label>Post</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="judul" value="{{$post->judul}}">
        @error('name') 
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Kategori</label>
        <select name="category_id" class="form-control">
            <option value="" holder>Pilih Kategori</option>
            @foreach ($category as $result)     
            <option value="{{ $result->id }}"
                {{-- tidak perlu looping, karena hanya mengambil satu data --}}
                    @if ($post->category_id === $result->id)
                        selected
                    @endif
                >{{ $result->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Pilih Tags</label>
        <select class="form-control select2" multiple="" name="tags[]">
            @foreach ($tags as $tag)
            <option value="{{$tag->id}}"
                {{-- lakukan looping karena mengambil banyak data/objek --}}
                @foreach ($post->tags as $value) 
                    @if ($tag->id === $value->id)
                        selected
                    @endif
                @endforeach
                >{{$tag->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Konten</label>
        <textarea name="content" class="form-control">{{$post->content}}</textarea>
    </div>
    <div class="form-group">
        <label>Thumbnail</label>
        <input type="file" name="gambar" class="form-control">
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block">Update Post</button>
    </div>
</form>
@endsection