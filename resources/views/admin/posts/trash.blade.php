@extends('../../layouts.main')

@section('content-header', 'Trashed Post')

@section('content-body')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<table class="table table-striped table-hover table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Post</th>
            <th scope="col">Kategori</th>
            <th scope="col">Thumbnail</th>
            <th scope="col">Tags</th>
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
                    <li>{{$tag->name}}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                <form action="{{ route('post.kill', $post->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <a href="{{ route('post.restore', $post->id) }}" class="btn btn-info btn-sm">Restore</a>
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Post akan dihapus secara permanen \nApakah anda yakin?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$posts->links()}}

@endsection