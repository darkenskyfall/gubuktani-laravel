<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Customers;
use App\Models\Wishlists;
use App\Models\Booking;
use App\Models\Rents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $ownAds = Ads::where('id_user', $customer->id)->get();
        $ads = Ads::where('status', 1)->get();
        $wishlists = Wishlists::where('id_user', $customer->id)->get();
        $bookings = Booking::where('id_user', $customer->id)->get();
        $rents = Rents::where('id_user', $customer->id)->get();

        $wIDS = [];
        foreach ($wishlists as $key => $value) {
            array_push($wIDS, $value->id_lahan);
        }

        $wAds = Ads::find($wIDS);

        $bIDS = [];
        foreach ($bookings as $key => $value) {
            array_push($bIDS, $value->id_lahan);
        }

        $bAds = Ads::find($bIDS);

        $rIDS = [];
        foreach ($rents as $key => $value) {
            array_push($rIDS, $value->id_lahan);
        }

        $rAds = Ads::find($rIDS);

        return view('ui.profile', ['customer' => $customer, 'ads' => $ownAds, 'wishlists' => $wAds, 'bookings' => $bAds, 'rents' => $rAds]);
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

    public function updateWishlist(Request $request, $id)
    {

        if(!(Auth::guard('web')->check())){
            return redirect('login');
        }

        $ad = DB::table('ads')->find($id);
        $user = DB::table('customers')->find($ad->id_user);
        $wishlist = DB::table('wishlists')->where(['id_lahan' => $ad->id, 'id_user' => Auth::guard('web')->user()->id])->first();

        if ($wishlist == null){
            $user = new Wishlists([
                'id_user' => Auth::guard('web')->user()->id,
                'id_lahan' => $id,
            ]);
            $user->save();
            return redirect()->route('profile', $id)->with('success', 'Wishlist ditambahkan!');
        }else{
            $data = Wishlists::find($wishlist->id);
            $data->delete();
            return redirect()->route('profile', $id)->with('success', 'Wishlist dihapus!');
        }
        
    }

    public function updateBooking(Request $request, $id)
    {

        if(!(Auth::guard('web')->check())){
            return redirect('login');
        }

        $ad = DB::table('ads')->find($id);
        $user = DB::table('customers')->find($ad->id_user);
        $booking = DB::table('bookings')->where(['id_lahan' => $ad->id, 'id_user' => Auth::guard('web')->user()->id])->first();

        if ($booking == null){
            $user = new Booking([
                'id_user' => Auth::guard('web')->user()->id,
                'id_lahan' => $id,
            ]);
            $user->save();
            return redirect()->route('profile', $id)->with('success', 'Booking ditambahkan!');
        }else{
            $data = Booking::find($booking->id);
            $data->delete();
            return redirect()->route('profile', $id)->with('success', 'Booking dihapus!');
        }
        
    }

}
