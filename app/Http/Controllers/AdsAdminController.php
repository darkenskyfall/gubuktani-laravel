<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Facilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdsAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ads::get();
        return view('adm.ads.index', ['ads' => $ads]);
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
        $ad = Ads::find($id);
        $facility = Facilities::firstWhere('id_ads', $id);
        return view('adm.ads.detail', ['ad' => $ad, 'facility' => $facility]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $data = Ads::find($id);
        $data->status = $request->status;
        $data->save();

        return redirect()->route('ads.admin')->with('success', $request->status == 0 ? 'Verifikasi iklan dibatalkan!' : 'Iklan berhasil diverifikasi!');
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
        return redirect()->route('ads.admin')->with('success', 'Data berhasil dihapus!');
    }
}
