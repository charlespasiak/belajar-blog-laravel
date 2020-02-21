@extends('../../layouts.main')

@section('content-header', 'Posts')

@section('content-body')
    
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    
    <a href="{{ route('post.create') }}" class="btn btn-info mb-4">Tambah Post</a>
    
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Post</th>
                <th scope="col">Kategori</th>
                <th scope="col">Thumbnail</th>
                <th scope="col">Tags</th>
                <th scope="col">Creator</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $key => $post)
            <tr>
                <th scope="row">{{$key + $posts->firstitem()}}</th>
                <td>{{$post->judul}}</td>
                <td>{{$post->category->name}}</td>
                <td><img src="{{ asset($post->gambar) }}" class="img-thumbnail" style="width:100px"></td>
                <td>
                    <ul>
                        @foreach ($post->tags as $tag)
                        <h6><span class="badge badge-info">{{$tag->name}}</span></h6>
                        @endforeach
                    </ul>
                </td>
                <td>{{$post->users->name}}</td>
                <td>
                    <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <button type="submit" class="btn btn-danger btn-sm d-inline"
                            onclick="return confirm('Apakah anda yakin?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$posts->links()}}

@endsection