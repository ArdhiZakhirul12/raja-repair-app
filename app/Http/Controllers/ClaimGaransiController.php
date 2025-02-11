<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\claimGaransi;
use Illuminate\Http\Request;

class ClaimGaransiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $booking = booking::where('user_id',auth()->id())->get();
        $garansi = claimGaransi::with('booking')->whereIn('booking_id', $booking->pluck('id'))->get();
        // dd($garansi);
        return view('customer-service.claim.list',compact('garansi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer-service.claim.create');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
