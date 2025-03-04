<?php

namespace App\Http\Controllers\teknisi;

use App\Http\Controllers\Controller;
use App\Models\claimGaransi;
use App\Models\teknisi;
use Auth;
use Illuminate\Http\Request;

class ClaimGaransiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $claimGaransi = claimGaransi::with('booking','booking.teknisi')->whereHas('booking', function ($q) {
            $auth_teknisi_id = Auth::user()->id;
            $teknisi_id = teknisi::where('user_id', $auth_teknisi_id)->first()->id;
            $q->where('teknisi_id', $teknisi_id);
        })->orderBy('created_at', 'asc')->paginate(5);

        // dd($claimGaransi);
        return view('teknisi.claim.teknisi-claim', compact('claimGaransi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $claim = claimGaransi::with(['booking'])
            ->where('id', $id)
            ->first();
        //
        return view('teknisi.claim.teknisi-claim-detail',compact('claim'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:dikerjakan,teknisi-selesai'
        ]);
        
        // if ($validated['status'] == 'dikerjakan') {
        //     workTimeBooking::create([
        //         'booking_id' => $id,
        //         'start' => now(),
        //         'end' => null
        //     ]);
        // } else {
        //     workTimeBooking::where('booking_id', $id)->update([
        //         'end' => now(),
        //     ]);
        // }
        $update = claimGaransi::where('id', $id)->update(['status'=> $validated['status']]);
        
        return redirect()->back()->with('msg', 'Berhasil mengubah status!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
