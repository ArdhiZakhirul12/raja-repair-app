<?php

namespace App\Http\Controllers;

use App\Models\antrian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {           
        $antrian = antrian::with('user')->where('user_id', Auth::user()?->id)->first();        
        return view('customer-service.antrian-ditangani', compact('antrian'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cekAntrian = antrian::where('user_id',Auth::user()?->id)->first();        
        if ($cekAntrian) {
        return redirect()->back();        
        }
        antrian::create([
            'user_id' => Auth::user()?->id,
            'antrian' => 0,
            'ditangani' => 0, 
            'status' => 'buka',
        ]);

        return redirect()->back();
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
    public function update(Request $request,)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'ditangani' =>'required|integer',
            'antrian' =>'nullable|integer'
        ]);

        $antrian = antrian::find($validated['id']);

        if($antrian){
            if($validated['ditangani'] <= $antrian->antrian){                  
            if(isset($validated['antrian'])){
                $antrian->antrian = $validated['antrian'];
            }
            
            $antrian->ditangani = $validated['ditangani'];
            $antrian->save();
            
            return response()->json(['success' => true, 'message' => 'Antrian berhasil diperbarui']);
            } 
            return response()->json(['success' => false, 'message' => 'Antrian sudah habis']);
        }
        return response()->json(['success' => false, 'message' => 'Antrian tidak ditemukan']);
    }
    public function status_update(Request $request,)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'status' =>'required| in:buka,tutup'
        ]);

        $antrian = antrian::find($validated['id']);

        if($antrian){                        
            $antrian->status = $validated['status'];
            $antrian->save();
            
            return redirect()->route('cs.antrian-ditangani');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
