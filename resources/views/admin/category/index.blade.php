@extends('../../layouts.main')

@section('content-header', 'Kategori')

@section('content-body')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<a href="{{ route('category.create') }}" class="btn btn-info mb-4">Tambah Kategori</a>

<table class="table table-striped table-hover table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            {{-- <th scope="col">Kategori</th> --}}
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
@foreach ($category as $key => $result)
        <tr>
            <th scope="row">{{$key + $category->firstitem()}}</th>
            <td>{{$result->name}}</td>
            {{-- <td>{{$result->slug}}</td> --}}
            <td>
                <form action="{{ route('category.destroy', $result->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <a href="{{ route('category.edit', $result->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <button type="submit" class="btn btn-danger btn-sm d-inline" onclick="return confirm('Apakah anda yakin?')">Delete</button>
                </form>
            </td>
        </tr>
@endforeach
    </tbody>
    </table>
{{$category->links()}}

@endsection