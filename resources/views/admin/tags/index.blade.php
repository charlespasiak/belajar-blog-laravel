@extends('../../layouts.main')

@section('content-header', 'Tags')

@section('content-body')
    
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    
    <a href="{{ route('tags.create') }}" class="btn btn-info mb-4">Tambah Tag</a>
    
    <table class="table table-striped table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Tag</th>
                {{-- <th scope="col">Kategori</th> --}}
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $key => $tag)
            <tr>
                <th scope="row">{{$key + $tags->firstitem()}}</th>
                <td>{{$tag->name}}</td>
                {{-- <td>{{$tag->slug}}</td> --}}
                <td>
                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <button type="submit" class="btn btn-danger btn-sm d-inline"
                            onclick="return confirm('Apakah anda yakin?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$tags->links()}}

@endsection