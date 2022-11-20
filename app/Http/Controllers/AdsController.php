<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Wishlists;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ads::where('status', '=', 1)->get();
        $search = "";
        return view('ui.list', ['ads' => $ads, 'search' => $search]);
    }

    public function search(Request $request)
    {
        // menangkap data pencarian
		$search = $request->search;
 
        // mengambil data dari table pegawai sesuai pencarian data
        $ads = Ads::where('title', 'like' ,"%".$search."%")->get();

            // mengirim data pegawai ke view index
        return view('ui.list',['ads' => $ads, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!(Auth::guard('web')->check())){
            return redirect()->route('login');
        }
        $cats = DB::table('categories')->get();
        return view('ui.add', ['cats' => $cats]);
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
            'id_category' => 'required',
            'title' => 'required',
            'address' => 'required',
            'large' => 'required',
            'certification' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'period' => 'required',
            // 'irigation' => 'required',
            // 'land' => 'required',
            // 'road' => 'required',
            // 'view' => 'required',
            // 'range' => 'required',
            // 'temperature' => 'required',
            // 'height' => 'required',
            // 'notice' => 'required',
            'picture_one' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'picture_two' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'picture_three' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'picture_four' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $picture_one = time().'.'.$request->picture_one->extension();  
        $request->picture_one->move(public_path('ads'), $picture_one);

        $picture_two = time().'.'.$request->picture_two->extension();  
        $request->picture_two->move(public_path('ads'), $picture_two);

        $picture_three = time().'.'.$request->picture_three->extension();  
        $request->picture_three->move(public_path('ads'), $picture_three);

        $picture_four = time().'.'.$request->picture_four->extension();  
        $request->picture_four->move(public_path('ads'), $picture_four);

        $user = new Ads([
            'id_user' => Auth::guard('web')->user()->id,
            'id_category' => $request->id_category,
            'title' => $request->title,
            'address' => $request->address,
            'large' => $request->large,
            'certification' => $request->certification,
            'desc' => $request->desc,
            'price' => $request->price,
            'period' => $request->period,
            'status' => 0, // 0 belum terverifikasi, 1 terverifikasi
            'condition' => 0, // 0 tersedia, 1 tersewa
            'irigation' => $request->irigation,
            'land' => $request->land,
            'road' => $request->road,
            'view' => $request->view,
            'range' => $request->range,
            'temperature' => $request->temperature,
            'height' => $request->height,
            'notice' => $request->notice,
            'picture_one' => $picture_one,
            'picture_two' => $picture_two,
            'picture_three' => $picture_three,
            'picture_four' => $picture_four,
        ]);

        $user->save();

        return redirect()->route('ads')->with('success', 'Iklan anda berhasil dibuat!, sedang menunggu verifikasi dari admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = Ads::find($id);
        $user = DB::table('customers')->find($ad->id_user);

        $wishlist = null;
        $booking = null;
        if(Auth::guard('web')->check()){
            $wishlist = DB::table('wishlists')->where(['id_lahan' => $ad->id, 'id_user' => Auth::guard('web')->user()->id])->first();
            $booking = DB::table('bookings')->where(['id_lahan' => $ad->id, 'id_user' => Auth::guard('web')->user()->id])->first();
        }
        return view('ui.detail', ['ad' => $ad, 'user' => $user, 'wishlist' => $wishlist, 'booking' => $booking]);
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
            return redirect()->route('ads.show', $id)->with('success', 'Wishlist ditambahkan!');
        }else{
            $data = Wishlists::find($wishlist->id);
            $data->delete();
            return redirect()->route('ads.show', $id)->with('success', 'Wishlist dihapus!');
        }
        
    }

    public function showBooking($id){
        if(!(Auth::guard('web')->check())){
            return redirect('login');
        }
        $ad = Ads::find($id);
        return view('ui.booking', ['ad' => $ad]);
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
            if ($ad->condition == 1){
                return redirect()->route('ads.show', $id)->with('error', 'Maaf, anda tidak bisa booking karena lahan telah tersewa!');
            }
            $user = new Booking([
                'id_user' => Auth::guard('web')->user()->id,
                'id_lahan' => $id,
            ]);
            if ($request->survey_date != null){
                $user->survey_date = $request->survey_date;
            }
            $user->save();
            return redirect()->route('ads.show', $id)->with('success', 'Booking ditambahkan!');
        }else{
            $data = Booking::find($booking->id);
            $data->delete();
            return redirect()->route('ads.show', $id)->with('success', 'Booking dihapus!');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ad = Ads::find($id);
        if ($ad->status == 0){
            return redirect()->back();
        }
        $cats = DB::table('categories')->get();
        return view('ui.adsEdit', ['ad' => $ad, 'cats' => $cats]);
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
            'id_category' => 'required',
            'title' => 'required',
            'address' => 'required',
            'large' => 'required',
            'certification' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'period' => 'required',
            // 'irigation' => 'required',
            // 'land' => 'required',
            // 'road' => 'required',
            // 'view' => 'required',
            // 'range' => 'required',
            // 'temperature' => 'required',
            // 'height' => 'required',
            // 'notice' => 'required',
        ]);

        $data = Ads::find($id);
        $data->id_category = $request->id_category;
        $data->title = $request->title;
        $data->address = $request->address;
        $data->large = $request->large;
        $data->certification = $request->certification;
        $data->desc = $request->desc;
        $data->price = $request->price;
        $data->period = $request->period;
        $data->irigation = $request->irigation;
        $data->land = $request->land;
        $data->road = $request->road;
        $data->view = $request->view;
        $data->range = $request->range;
        $data->temperature = $request->temperature;
        $data->height = $request->height;
        $data->notice = $request->notice;

        if ($image = $request->file('picture_one')) {
            $imageName = time().'.'.$request->picture_one->extension();  
            $request->picture_one->move(public_path('profiles'), $imageName);
            $data->picture_one = "$imageName";
        }

        if ($image = $request->file('picture_two')) {
            $imageName = time().'.'.$request->picture_two->extension();  
            $request->picture_two->move(public_path('profiles'), $imageName);
            $data->picture_two = "$imageName";
        }

        if ($image = $request->file('picture_three')) {
            $imageName = time().'.'.$request->picture_three->extension();  
            $request->picture_three->move(public_path('profiles'), $imageName);
            $data->picture_three = "$imageName";
        }

        if ($image = $request->file('picture_four')) {
            $imageName = time().'.'.$request->picture_four->extension();  
            $request->picture_four->move(public_path('profiles'), $imageName);
            $data->picture_four = "$imageName";
        }

        $data->save();

        return redirect()->route('profile')->with('success', 'Iklan anda berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Ads::find($id);
        $data->delete();
        return redirect()->route('profile')->with('success', 'Data berhasil dihapus!');
    }
}
