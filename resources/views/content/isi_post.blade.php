@extends('../blog.master')

@section('landing-page')
    <div id="post-header" class="page-header">
        @foreach ($data as $isiPost)
        <div class="page-header-bg" style="background-image: url('{{ asset($isiPost->gambar) }}');"
            data-stellar-background-ratio="0.5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="post-category">
                        <a href="category.html">{{ $isiPost->category->name }}</a>
                    </div>
                    <h1>{{ $isiPost->judul }}</h1>
                    <ul class="post-meta">
                        <li><a href="author.html">{{ $isiPost->users->name }}</a></li>
                        <li>{{ $isiPost->created_at->diffForHumans() }}</li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

@section('content')
    @foreach ($data as $isiPost)
        {!!$isiPost->content!!} {{-- tanda seru digunakan untuk mengeksekusi elemen HTML --}}
    @endforeach
@endsection