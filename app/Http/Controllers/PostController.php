<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Auth; // mengunakan Auth 
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $category = Category::all();
        return view('admin.posts.create', compact('category', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'gambar' => 'required'
        ]);

        $gambar = $request->gambar;
        $newGambar = time().$gambar->getClientOriginalName();

        $post = Post::create([
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'gambar' => 'uploads/posts/'.$newGambar, // link untuk menampilkan gambar
            'slug' => Str::slug($request->judul),
            'users_id' => Auth::id()
        ]);
            // untuk memasukkan data baru : attach()
        $post->tags()->attach($request->tags); // memanggil fungsi/method dari model Post | fungsi tags()

        $gambar->move('uploads/posts', $newGambar); // memindahkan gambar yg diupload ke dalam folder public

        return redirect()->back()->with('status', 'Postingan Anda berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::all();
        $category = Category::all();
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', ['post' => $post, 'category' => $category, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'category_id' => 'required',
            'content' => 'required'
        ]);

        $post = Post::findOrFail($id);

        if ($request->has('gambar')) {
            $gambar = $request->gambar;
            $newGambar = time() . $gambar->getClientOriginalName();
            $gambar->move('uploads/posts', $newGambar); // memindahkan gambar yg diupload ke dalam folder public

            $postData = [
                'judul' => $request->judul,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'gambar' => 'uploads/posts/' . $newGambar, // link untuk menampilkan gambar
                'slug' => Str::slug($request->judul)
            ];
        } else {
            $postData = [
                'judul' => $request->judul,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'slug' => Str::slug($request->judul)
            ];
        }

         // sync() : untuk meng-update data
        $post->tags()->sync($request->tags); // memanggil fungsi/method dari model Post | fungsi tags()
        $post->update($postData);
        

        return redirect()->route('post.index')->with('status', 'Postingan Anda berhasil di-update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id); // cari data dengan id = $id
        $post->delete();

        return redirect()->back()->with('status', 'Post telah dihapus! (silahkan cek trashed post!)');
    }

    public function showTrash()
    {
        $posts = Post::onlyTrashed()->paginate(10);
        return view('admin.posts.trash', compact('posts'));
    }

    public function restore($id)
    {
        Post::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('status', 'Post berhasil di-restore!');
    }

    public function kill($id)
    {
        Post::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->back()->with('status', 'Post berhasil dihapus secara permanen!');
    }
}
