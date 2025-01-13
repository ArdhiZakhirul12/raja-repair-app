<?php

namespace App\Http\Controllers;

use App\Models\dataService;
use Auth;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = dataService::where('user_id',Auth::user()->id)->get();

        return view('customer-service.service.list',compact('services'));
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
            'nama_servis' => 'required|string|min:3',
            'jenis_servis' => 'required',
            'status' =>'1',
            'harga' => 'required|integer',            
        ]);        
        $validated['user_id'] = $auth->id;
        dataService::create($validated);
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
    public function update(Request $request, string $id)
    {
        //
    }
    public function updateStatus(Request $request)
    {                
        
        // $validated = $request->validate([            
        //     'status' => 'required',
        // ]); 

        $service = dataService::find($request->id);
        if (isset($service)) {
            $service->status = $request->status;
            $service->save();
            return response()->json(['success' => true, 'message' => 'berhasil mengubah status service']);
        
        }
        
        return response()->json(['success' => false, 'message' => 'Sparepart not found'], 404);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
