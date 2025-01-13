<?php

namespace App\Http\Controllers;

use App\Models\sparepart;
use Auth;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spareparts = sparepart::where('user_id',Auth::user()->id)->get();

        return view('customer-service.sparepart.list',compact('spareparts'));
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
        $auth = Auth::user();
        $validated = $request->validate([
            'nama_sparepart' => 'required|string|min:3',
            'harga' => 'required|integer',            
        ]);        
        $validated['user_id'] = $auth->id;
        sparepart::create($validated);
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
    public function update(Request $request)
    {
        
        $validated = $request->validate([
            'nama_sparepart' => 'required|string|min:3',
            'harga' => 'required|integer',            
        ]); 
        
        sparepart::where('id', $request->id)->update($validated);
        return redirect()->back()->with('msg','berhasil mengedit sparepart');
    }
    public function updateStatus(Request $request)
    {
        
        $validated = $request->validate([
            'status' => 'required'
        ]); 
        
        sparepart::where('id', $request->id)->update($validated);
        return redirect()->back()->with('msg','berhasil mengubah status sparepart');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
