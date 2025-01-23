<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = booking::with(['sparepart_booking','detailBooking'])->where('user_id', auth()->id())->get();
        return view('customer-service.booking.list', compact('bookings'));
    }


    
    public function getBooking()
{
    $bookings = booking::with(['sparepart_booking','detailBooking'])->where('user_id', auth()->id())->get();
    // $customers = customer::where('user_id',Auth::user()->id)->get();

    return DataTables::of($bookings)
        // ->addColumn('action', function ($customer) {
        //     return '<a href="/customer/edit/'.$customer->id.'" class="btn btn-sm btn-primary">Edit</a>';
        // })
        ->rawColumns(['action'])
        ->make(true);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer-service.booking.create');
    }
    public function searchCustomer(String $nohp)
    {
        $customer = customer::where('user_id',auth()->id())->where('nohp', $nohp)->first();
        if ($customer) {
            return response()->json([
                'exists' => true,
                'customer' => $customer
            ]);
        }
        return response()->json(['exists' => false]);
    
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function displayDetail()
    {
        return view('livewire.detail-booking');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('customer-service.booking.detail');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $bookings = booking::with(['sparepart_booking','detailBooking'])->where('user_id', auth()->id())->get();
        return view('customer-service.booking.detail', ['id' => $id]);
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
