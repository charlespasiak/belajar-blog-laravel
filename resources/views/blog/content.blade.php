<!-- HEADER -->
@include('blog.header')
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <div id="hot-post" class="row hot-post">
            <div class="col-md-8 hot-post-left">
        @yield('konten')
        @include('blog.widget')
            </div>
        </div>
    </div>
</div>

@include('blog.footer')