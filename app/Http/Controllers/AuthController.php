<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('ui.login');
    }

    public function register()
    {
        return view('ui.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRegister(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|unique:customers',
            'address' => 'required',
            'phone' => 'required',
            'work' => 'required',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->profile_picture->extension();  
        $request->profile_picture->move(public_path('profiles'), $imageName);

        $user = new Customers([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'work' => $request->work,
            'password' => Hash::make($request->password),
            'profile_picture' => $imageName,
        ]);
        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi Berhasil. Silakan Login!');
    }

    public function authenticate(){
        ///
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
