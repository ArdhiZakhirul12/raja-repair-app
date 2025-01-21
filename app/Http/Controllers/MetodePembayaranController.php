<?php

namespace App\Http\Controllers;

use App\Models\metodePembayaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayarans = metodePembayaran::where('user_id', auth()->id())->get();
        return view('customer-service.pembayaran.list', compact('pembayarans'));
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
        $validated = $request->validate([
            'metode' => [
                'required',
                'string',
                'min:3',
                Rule::unique('metode_pembayarans', 'metode')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),
            ],
        ]);
        $validated['user_id'] = auth()->id();
        metodePembayaran::create($validated);
        return redirect()->route('cs.pembayaran.index')->with('success', 'Metode pembayaran berhasil ditambahkan!');
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
