<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->route('home');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if ((Auth::guard('web')->check())){
            return redirect()->route('home');
        }
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
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'email' => 'required|unique:customers|max:50',
            'address' => 'required|max:50',
            'phone' => 'required|max:50',
            'work' => 'required|in:TNI,POLRI,ASN,PNS,Swasta,Lainnya',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ktp' => 'required|max:16',
            'ktp_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->profile_picture->extension();  
        $request->profile_picture->move(public_path('profiles'), $imageName);

        $imageKTP = time().'.'.$request->ktp_picture->extension();  
        $request->ktp_picture->move(public_path('profiles'), $imageKTP);


        $user = new Customers([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'work' => $request->work,
            'password' => Hash::make($request->password),
            'profile_picture' => $imageName,
            'ktp' => $request->ktp,
            'ktp_picture' => $imageKTP,
        ]);
        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi Berhasil. Silakan Login!');
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

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('login');
    }

}
