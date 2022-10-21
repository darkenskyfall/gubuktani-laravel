<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Customers;
use App\Models\Wishlists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customers::find(Auth::guard('web')->user()->id);
        $ads = Ads::where('id_user', $customer->id)->get();
        $wishlists = Wishlists::where('id_user', $customer->id)->get();

        $wAds = [];
        foreach ($wishlists as $key => $value) {
            $newAds = $ads->where('id', $value->id_lahan);
            array_push($wAds, $newAds);
        }

        return view('ui.profile', ['customer' => $customer, 'ads' => $ads, 'wishlists' => $wAds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $customer = Customers::find($id);
        return view('ui.profileEdit', ['customer' => $customer]);
    }

    public function changePassword($id)
    {
        $customer = Customers::find($id);
        return view('ui.changePassword', ['customer' => $customer]);
    }

    public function updatePassword(Request $request, $id){
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        Customers::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("success", "Password berhasil diperbarui!");
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
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'work' => 'required',
        ]);
        

        $user = Customers::find($id);

        $user->fname = $request->fname;
        $user->lname = $request->lname;
        if ($user->email != $request->email){
            $user->email = $request->email;
        }
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->work = $request->work;

        if ($image = $request->file('profile_picture')) {
            $imageName = time().'.'.$request->profile_picture->extension();  
            $request->profile_picture->move(public_path('profiles'), $imageName);
            $user->profile_picture = "$imageName";
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diganti');
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
