@extends('../../layouts.main')

@section('content-header', 'User')

@section('content-body')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<a href="{{ route('user.create') }}" class="btn btn-info mb-4">Tambah User</a>

<table class="table table-striped table-hover table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Type</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $key => $user)
        <tr>
            <th scope="row">{{$key + $users->firstitem()}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                @if ($user->tipe === 1)
                    <span class="badge badge-info">Administrator</span>
                    @else
                        <span class="badge badge-warning">Author</span>
                @endif
            </td>
            <td>
                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <button type="submit" class="btn btn-danger btn-sm d-inline"
                        onclick="return confirm('Apakah anda yakin?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$users->links()}}

@endsection