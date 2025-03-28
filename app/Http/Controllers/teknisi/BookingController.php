<?php

namespace App\Http\Controllers\teknisi;

use App\Http\Controllers\Controller;
use App\Models\workTimeBooking;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\teknisi;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $status)
    {   
        $auth_teknisi_id = Auth::user()->id;
        $teknisi_id = teknisi::where('user_id', $auth_teknisi_id)->first()->id;
        $bookings = Booking::with(['hpModel','sparepart_booking','detailBooking'])->where('teknisi_id', $teknisi_id)->where('status', $status)->orderBy('created_at', 'asc')->paginate(5);

        // dd($bookings);
        return view('teknisi.booking.teknisi-booking',compact('bookings'));
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
        $booking = Booking::with(['hpModel','sparepart_booking','detailBooking'])
            // ->where('teknisi_id', $teknisi_id)
            ->where('id', $id)
            ->first();
        //
        // dd($booking);
        return view('teknisi.booking.teknisi-booking-detail',compact('booking'));
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
        
        if ($validated['status'] == 'dikerjakan') {
            workTimeBooking::create([
                'booking_id' => $id,
                'start' => now(),
                'end' => null
            ]);
        } else {
            workTimeBooking::where('booking_id', $id)->update([
                'end' => now(),
            ]);
        }
        $update = booking::where('id', $id)->update(['status'=> $validated['status']]);
        
        return redirect()->back();
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
