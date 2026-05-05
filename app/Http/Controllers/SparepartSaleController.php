<?php

namespace App\Http\Controllers;

use App\Models\booking;
use Illuminate\Http\Request;

class SparepartSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = booking::with(['hpModel', 'sparepart_booking', 'detailBooking'])->where('user_id', auth()->id())->orderBy('created_at', 'asc')->get();
        // dd($bookings);
        return view('customer-service.sparepart-sale.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer-service.sparepart-sale.create');
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
