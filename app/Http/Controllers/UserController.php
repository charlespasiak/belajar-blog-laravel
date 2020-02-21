<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'name' => 'required|min:3',
            'email' => 'required|email',
            'tipe' => 'required'
        ]);

            // kondisi jika user tidak memasukkan password, maka digunakan password default
        if ($request->input('password')) { // has digunakan untuk file / gambar | selain itu gunakan input
            $password = bcrypt($request->password);
        } else {
            $password = bcrypt('1234');
        }

        User::create([
            'name' => $request->name,
            'password' => $password,
            'email' => $request->email,
            'tipe' => $request->tipe
        ]);

        return redirect()->back()->with('status', 'User berhasil ditambahkan!');
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
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
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
            'name' => 'required|min:3',
            'tipe' => 'required'
        ]);

        // kondisi jika user tidak memasukkan password, maka digunakan password default
        if ($request->input('password')) { // has digunakan untuk file / gambar | selain itu gunakan input
            $userData = [
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'tipe' => $request->tipe
            ];
        } else {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'tipe' => $request->tipe
            ];
        }

        User::where('id', $id)->update($userData);

        return redirect()->route('user.index')->with('status', 'User berhasil di-update!');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('status', 'User telah dihapus!');
    }
}
