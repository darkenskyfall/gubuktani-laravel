<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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


            if (Auth::guard('web')->user()->email_verified_at == NULL){
                $id = Auth::guard('web')->user()->id;
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                $token = Str::random(64);

                UserVerify::create([
                    'user_id' => $id,
                    'token' => $token
                ]);

                Mail::send('ui.email.emailVerificationEmail', ['token' => $token], function($message) use($request){
                    $message->to($request->email);
                    $message->subject('Email Verification Mail');
                });
                return view("ui.verification", ["id" => $id, "email" => $request->email]);
            }
 
            return redirect()->route('home');
        }
 
        return back()->withErrors([
            'email' => 'Email tidak cocok dengand data kami.',
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
        $request->ktp_picture->move(public_path('ktps'), $imageKTP);


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

        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        Mail::send('ui.email.emailVerificationEmail', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });

        return view("ui.verification", ["id" => $user->id, "email" => $user->email]);
    }

    public function resendEmail(Request $request){
        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $request->id,
            'token' => $token
        ]);

        Mail::send('ui.email.emailVerificationEmail', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });
        
        return view("ui.verification", ["id" => $request->id, "email" => $request->email]);
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
              
            if(!$user->email_verified_at) {
                $verifyUser->user->email_verified_at = Carbon::now();
                $verifyUser->user->ktp_verified_at = NULL;
                $verifyUser->user->save();
                $message = "Email anda berhasil di verifikasi. anda bisa login sekarang.";
            } else {
                $message = "Email anda sudah di verifikasi. anda bisa login sekarang";
            }
        }
  
      return redirect()->route('login')->with('message', $message);
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
