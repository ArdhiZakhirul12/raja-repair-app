<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
