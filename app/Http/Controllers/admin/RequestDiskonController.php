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
        return view('admin.request-diskon.index',compact('booking'));
    }
    public function getDiskon()
    {
        $query = booking::with(['hpModel', 'user', 'detailBooking', 'customer'])->where('diskon_status',1);

        $bookings = $query->orderBy('created_at', 'desc')->get();
        
        
        return DataTables::of($bookings)
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
        return view('admin.request-diskon.show',['id' => $id]);
        
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
