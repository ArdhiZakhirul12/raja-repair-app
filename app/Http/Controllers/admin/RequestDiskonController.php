<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\booking;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RequestDiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booking = booking::where('diskon_status', 1)->get();
        return view('admin.request-diskon.index', compact('booking'));
    }
    public function getDiskon()
    {
        $query = booking::with(['hpModel', 'user', 'user.cabang', 'detailBooking', 'sparepart_booking', 'customer'])
            ->where('diskon_status', 1);

        $bookings = $query->orderBy('created_at', 'desc')->get()->map(function ($booking) {
            // Hitung total dari detailBooking
            $totalDetail = $booking->detailBooking->sum('harga');

            // Hitung total dari sparepart_booking
            $totalSparepart = $booking->sparepart_booking->sum('harga');

            // Total keseluruhan
            $booking->total_harga = $totalDetail + $totalSparepart;

            return $booking;
        });

        return DataTables::of($bookings)
            ->addColumn('total_harga', function ($booking) {
                return number_format($booking->total_harga, 0, ',', '.'); // Format Rupiah tanpa desimal
            })
            ->rawColumns(['action'])
            ->make(true);

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
        return view('admin.request-diskon.show', ['id' => $id]);

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
