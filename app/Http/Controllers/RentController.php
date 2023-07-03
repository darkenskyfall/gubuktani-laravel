<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Booking;
use App\Models\Instalments;
use App\Models\Rents;
use Carbon\Carbon;
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
        if (!(Auth::guard('web')->check())) {
            return redirect('login');
        }
        $user = Auth::guard('web')->user();
        $book = Booking::firstWhere(['id_lahan' => $id, 'id_user' => $user->id]);
        if ($book == null) {
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

        $agreement = time() . '.' . $request->agreement_photo->extension();
        $request->agreement_photo->move(public_path('agreement'), $agreement);

        $fix_price = $request->done_price * $request->period; 

        $data = new Rents([
            'id_user' => Auth::guard('web')->user()->id,
            'id_lahan' => $request->id_lahan,
            'done_price' => $fix_price,
            'period' => $request->period,
            'period_type' => $request->period_type,
            'method' => $request->method,
            'agreement_photo' => $agreement,
            'status' => 0,
            'status_instalment' => 0,
        ]);

        $data->save();

        $totalMonth = ($request->period * 12);

        for ($i = 1; $i <= $totalMonth; $i++) {
            $install = new Instalments([
                'id_user' => Auth::guard('web')->user()->id,
                'id_lahan' => $request->id_lahan,
                'id_rent' => $data->id,
                'month' => Carbon::now()->addMonths($i)->format('F') . " " . Carbon::now()->addMonths($i)->format('Y'),
                'amount' => ($fix_price / $totalMonth),
                'status' => 0,
            ]);
            $install->save();
        }

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
        $installments = Instalments::where('id_rent', $rent->id)->get();

        return view('ui.rentDetail', ['ad' => $ad, 'rent' => $rent, 'instalments' => $installments]);
    }

    public function showFromAdsDetail($id)
    {
        $rent = Rents::find($id);
        $ad = Ads::find($rent->id_lahan);
        
        $instalList = Instalments::where('id_rent', $rent->id)->get();
        return view('ui.rentDetail', ['ad' => $ad, 'rent' => $rent, 'instalments' => $instalList]);
    }

    public function showUploadForm($id)
    {
        $instalment = Instalments::find($id);
        if ($instalment->proof_of_payment != null) {
            return redirect()->back();
        }
        return view('ui.rentUpload', ['instalment' => $instalment]);
    }

    public function uploadProofOfPayment(Request $request, $id)
    {
        $instalment = Instalments::find($id);
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $img = time() . '.' . $request->proof_of_payment->extension();
        $request->proof_of_payment->move(public_path('ProofOfPayments'), $img);
        $instalment->proof_of_payment = $img;
        $instalment->save();
        return redirect()->route('rent.show.fromAds', $instalment->id_rent)->with('success', 'Bukti bayar berhasil diunggah');
    }

    public function approveProofOfPayment($id)
    {
        $instalment = Instalments::find($id);
        $instalment->status = 1;
        $instalment->save();
        return redirect()->route('rent.show.fromAds', $instalment->id_rent)->with('success', 'Cicilan berhasil disetujui');
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
