<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Wishlists;
use App\Models\Booking;
use App\Models\Categories;
use App\Models\Facilities;
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
        $ads = Ads::where('status', 1)->get()->reverse();
        $search = "";
        return view('ui.list', ['ads' => $ads, 'search' => $search]);
    }

    public function search(Request $request)
    {
        if ($request->id != null){
            $id = $request->id;

            $category = Categories::find($id);
            $ads = Ads::where('id_category', $id)->get();

            return view('ui.list',['ads' => $ads, 'category' => $category]);
        }else{
            // menangkap data pencarian
            $search = $request->search;
    
            // mengambil data dari table pegawai sesuai pencarian data
            $ads = Ads::where('title', 'like' ,"%".$search."%")->get();

                // mengirim data pegawai ke view index
            return view('ui.list',['ads' => $ads, 'search' => $search]);
        }
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
        if (Auth::guard('web')->user()->ktp_verified_at == NULL){
            return redirect()->route('home')->with('error', "Anda tidak bisa mengakses halaman ini karena akun anda sedang ditinjau");
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
            'title' => 'required|max:60',
            'address' => 'required|max:60',
            'large' => 'required|max:60',
            'certification' => 'required|max:60',
            'desc' => 'required|max:255',
            'price' => 'required|max:60',
            'period' => 'required|max:60',
            'irigation' => 'max:60',
            'land' => 'max:60',
            'road' => 'max:60',
            'view' => 'max:60',
            'range' => 'max:60',
            'temperature' => 'max:60',
            'height' => 'max:60',
            'notice' => 'max:255',
            'picture_one' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'picture_two' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'picture_three' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'picture_four' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $picture_one = time().'-one.'.$request->picture_one->extension();  
        $request->picture_one->move(public_path('ads'), $picture_one);

        $picture_two = time().'-two.'.$request->picture_two->extension();  
        $request->picture_two->move(public_path('ads'), $picture_two);

        $picture_three = time().'-three.'.$request->picture_three->extension();  
        $request->picture_three->move(public_path('ads'), $picture_three);

        $picture_four = time().'-four.'.$request->picture_four->extension();  
        $request->picture_four->move(public_path('ads'), $picture_four);

        $price = (int) str_replace(',', '', $request->price);

        $user = new Ads([
            'id_user' => Auth::guard('web')->user()->id,
            'id_category' => $request->id_category,
            'title' => $request->title,
            'address' => $request->address,
            'large' => $request->large,
            'certification' => $request->certification,
            'desc' => $request->desc,
            'price' => $price,
            'period' => $request->period,
            'status' => 0, // 0 belum terverifikasi, 1 terverifikasi
            'condition' => 0, // 0 tersedia, 1 tersewa
            'is_irigation' => $request->is_irigation,
            'irigation' => $request->irigation,
            // 'land' => $request->land,
            // 'road' => $request->road,
            // 'view' => $request->view,
            // 'range' => $request->range,
            // 'temperature' => $request->temperature,
            // 'height' => $request->height,
            'notice' => $request->notice,
            'picture_one' => $picture_one,
            'picture_two' => $picture_two,
            'picture_three' => $picture_three,
            'picture_four' => $picture_four,
        ]);

        $user->save();

        $facilites = new Facilities([
            'id_ads' => $user->id,
            'land' => $request->land,
            'road' => $request->road,
            'view' => $request->view,
            'range' => $request->range,
            'temperature' => $request->temperature,
            'height' => $request->height,
        ]);

        $facilites->save();

        return redirect()->route('ads')->with('success', 'Iklan anda berhasil dibuat!, untuk mendukung validasi, anda bisa mengirimkan attachment berupa surat-surat pendukung seperti sertifikat dan akta penjualan ke email support@gubuktani.com demi mempercepat validitas dari iklan');
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
        $facility = Facilities::firstWhere('id_ads', $id);
        return view('ui.detail', [
            'ad' => $ad, 
            'user' => $user, 
            'wishlist' => $wishlist, 
            'booking' => $booking, 
            'facility' => $facility
        ]);
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
        $facility = Facilities::firstWhere('id_ads', $id);
        return view('ui.adsEdit', [
            'ad' => $ad, 
            'cats' => $cats,
            'facility' => $facility
        ]);
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
            'title' => 'required|max:60',
            'address' => 'required|max:60',
            'large' => 'required|max:60',
            'certification' => 'required|max:60',
            'desc' => 'required|max:255',
            'price' => 'required|max:60',
            'period' => 'required|max:60',
            'irigation' => 'max:60',
            'land' => 'max:60',
            'road' => 'max:60',
            'view' => 'max:60',
            'range' => 'max:60',
            'temperature' => 'max:60',
            'height' => 'max:60',
            'notice' => 'max:255',
        ]);

        $price = (int) str_replace(',', '', $request->price);

        $data = Ads::find($id);
        $data->id_category = $request->id_category;
        $data->title = $request->title;
        $data->address = $request->address;
        $data->large = $request->large;
        $data->certification = $request->certification;
        $data->desc = $request->desc;
        $data->price = $price;
        $data->period = $request->period;
        $data->notice = $request->notice;
        $data->is_irigation = $request->is_irigation;
        if ($request->is_irigation == 1){
            $data->irigation = $request->irigation;
        }else{
            $data->irigation = NULL;
        }

        if ($image = $request->file('picture_one')) {
            $imageName = time().'-one.'.$request->picture_one->extension();  
            $request->picture_one->move(public_path('ads'), $imageName);
            $data->picture_one = "$imageName";
        }

        if ($image = $request->file('picture_two')) {
            $imageName = time().'-two.'.$request->picture_two->extension();  
            $request->picture_two->move(public_path('ads'), $imageName);
            $data->picture_two = "$imageName";
        }

        if ($image = $request->file('picture_three')) {
            $imageName = time().'-three.'.$request->picture_three->extension();  
            $request->picture_three->move(public_path('ads'), $imageName);
            $data->picture_three = "$imageName";
        }

        if ($image = $request->file('picture_four')) {
            $imageName = time().'-four.'.$request->picture_four->extension();  
            $request->picture_four->move(public_path('ads'), $imageName);
            $data->picture_four = "$imageName";
        }

        $data->save();

        $facility = Facilities::firstWhere('id_ads', $id);
        $facility->land = $request->land;
        $facility->road = $request->road;
        $facility->view = $request->view;
        $facility->range = $request->range;
        $facility->temperature = $request->temperature;
        $facility->height = $request->height;

        $facility->save();


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
