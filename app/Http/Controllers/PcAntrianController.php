<?php

namespace App\Http\Controllers;
use App\Models\antrian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PcAntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $antrian = antrian::where('user_id', Auth::user()?->id)->first();
        return view('customer-service.pc-antrian', compact('antrian'));
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
    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'antrian' => 'required|integer'
        ]);

        $antrian = antrian::find($validated['id']);
        if ($antrian->status == 'tutup'){
            return response()->json(['success' => false, 'message' => 'Antrian tidak ditemukan']);

        }
        if ($antrian) {
            $antrian->antrian = $validated['antrian'];
            $antrian->save();
            return response()->json(['success' => true, 'message' => 'Antrian berhasil diperbarui']);

        }
        return response()->json(['success' => false, 'message' => 'Antrian tidak ditemukan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
