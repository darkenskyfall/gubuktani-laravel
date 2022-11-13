<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Booking;
use App\Models\Rents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function form($id)
    {
        if(!(Auth::guard('web')->check())){
            return redirect('login');
        }
        $user = Auth::guard('web')->user();
        $book = Booking::firstWhere(['id_lahan' => $id, 'id_user' => $user->id]);
        if ($book == null){
            return redirect()->route('ads.show', $id)->with('error', 'Anda harus booking terlebih dahulu');
        }
        $ad = Ads::find($id);
        return view('ui.rent', ['ad' => $ad]);
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
        $request->validate([
            'done_price' => 'required',
            'period' => 'required',
            'period_type' => 'required',
            'method' => 'required',
            'agreement_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $agreement = time().'.'.$request->agreement_photo->extension();  
        $request->agreement_photo->move(public_path('agreement'), $agreement);

        $user = new Rents([
            'id_user' => Auth::guard('web')->user()->id,
            'id_lahan' => $request->id_lahan,
            'done_price' => $request->done_price,
            'period' => $request->period,
            'period_type' => $request->period_type,
            'method' => $request->method,
            'agreement_photo' => $agreement,
            'status' => 0,
        ]);

        $user->save();

        return redirect()->route('ads')->with('success', 'Proses sewa berhasil dikirim, silahkan tunggu persetujuan dari pemilik lahan');
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
        $user = Auth::guard('web')->user();
        $rent = Rents::firstWhere(['id_lahan' => $ad->id, 'id_user' => $user->id]);
        return view('ui.rentDetail', ['ad' => $ad, 'rent' => $rent]);
    }

    public function showFromAdsDetail($id){
        $rent = Rents::find($id);
        $ad = Ads::find($rent->id_lahan);
        return view('ui.rentDetail', ['ad' => $ad, 'rent' => $rent]);
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
        $rent = Rents::find($id);
        $rent->status = 1;
        $rent->save();

        $ad = Ads::find($rent->id_lahan);
        $ad->condition = 1;
        $ad->save();

        Booking::where('id_lahan', $ad->id)->delete();

        return redirect()->route('profile')->with('success', 'Penyewa berhasil disetujui');
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
