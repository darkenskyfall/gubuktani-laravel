<?php

namespace App\Http\Controllers;

use App\Models\Ads;
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
        $ads = DB::table('ads')->get();
        return view('ui.list', ['ads' => $ads]);
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
            'irigation' => 'required',
            'land' => 'required',
            'road' => 'required',
            'view' => 'required',
            'range' => 'required',
            'temperature' => 'required',
            'height' => 'required',
            'notice' => 'required',
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

        return redirect()->route('ads')->with('success', 'Iklan anda berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = DB::table('ads')->find($id);
        $user = DB::table('customers')->find($ad->id_user);
        return view('ui.detail', ['ad' => $ad, 'user' => $user]);
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
        $data = Ads::find($id);
        $data->delete();
        return redirect()->route('profile')->with('success', 'Data berhasil dihapus!');
    }
}
