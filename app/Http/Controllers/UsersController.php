<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Storage;
use File;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $this->authorize('pass', $user);

        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = \Auth::user();
        $this->authorize('pass', $user);

        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = \Auth::user();
        $this->authorize('pass', $user);

        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
        ]);

        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
            'avatar' => 'default.png',
            'password' => bcrypt('password'),
        ]);

        return redirect()->route('usuarios.index')->with('info', 'Usuario creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \Auth::user();
        $this->authorize('pass', $user);

        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = \Auth::user();
        $this->authorize('pass', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = \Auth::user();
        $this->authorize('pass', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = \Auth::user();
        $this->authorize('pass', $user);
    }

    public function profile(){
        $user = \Auth::user();
        return view('users.profile', compact('user'));
    }

    public function update_avatar(Request $request){
        $this->validate($request, [
            'avatar' => 'required|image'
        ],[
            'required' => 'Debe seleccionar una imagen',
            'image' => 'Solo se admiten imagenes jpeg, png, bmp, o gif'
        ]);

        if($request->hasFile('avatar')){
            $user = \Auth::user();
            // *****************************
            if($user->avatar != 'default.png'){
                File::delete(public_path() . '/images/avatar/'.$user->avatar); // Delete
                // dd(public_path() . '/images/avatar'.$user->avatar);
            }

            // *****************************
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path('/images/avatar/'.$filename));
            
            $user->avatar = $filename;
            $user->save();
            return redirect()->route('profile', compact('user'))->with('info', 'Avatar actualizado!');
        }
    }
}
