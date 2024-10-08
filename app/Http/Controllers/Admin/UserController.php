<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            'auth',
            'role_or_permission:user-module',
        ];
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles','image')->orderBy('id', 'ASC')->get();
        return view('adminpanel.users.index', compact('users'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('adminpanel.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|string',
            'password' => 'required|string', 
            'file' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',   
            'role' => 'required'       
        ]);

        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();


        // using Morph Relation for image with IMAGE Model
        if ($request->hasFile('file') && $user) {
            $service = new ImageService();
            $service->store($request, $user);          
        }
        
        $user->assignRole($request->role);
        return back();       
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
        $user = User::with('image','roles')->find($id);
        return view('adminpanel.users.edit', compact('user'));
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|string',
            'file' => 'nullable|mimes:jpeg,jpg,png',   
        ]);

        
        $user = User::with('images')->find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        if(isset($request->password)){
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('file') && $user) {
            $service = new ImageService();
            $service->store($request, $user);          
        }

        $user->assignRole($request->role);

        return back();    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::find($id);
        $user->delete();

        return back();
    }
}
