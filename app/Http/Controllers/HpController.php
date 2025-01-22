<?php

namespace App\Http\Controllers;

use App\Models\hpMerk;
use App\Models\hpModel;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class HpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merks = hpMerk::where('user_id',auth()->id())->get();
        $merkIds = $merks->pluck('id'); // Mengambil hanya ID

        // Ambil Model yang hp_merk_id-nya ada di daftar ID Merk
        $models = HpModel::whereIn('hp_merk_id', $merkIds)->get();

        return view('customer-service.hp.list',compact('merks','models'));
        // return view('customer-service.hp.list');
    }



                      /**
     * Get all model data
     */
    public function getHpModel()
    {
        $merks = hpMerk::where('user_id',auth()->id())->get();
        $merkIds = $merks->pluck('id'); // Mengambil hanya ID

        // Ambil Model yang hp_merk_id-nya ada di daftar ID Merk
        $models = HpModel::whereIn('hp_merk_id', $merkIds)->get();

    
        return DataTables::of($models)
            // ->addColumn('action', function ($teknisi) {
            //     return '<a href="/teknisi/edit/'.$teknisi->id.'" class="btn btn-sm btn-primary">Edit</a>';
            // })
            ->rawColumns(['action'])
            ->make(true);
    }




                          /**
     * Get all merk data
     */
    public function getHpMerk()
    {
        $merks = hpMerk::where('user_id',auth()->id())->get();
        // $merkIds = $merks->pluck('id'); // Mengambil hanya ID

        // // Ambil Model yang hp_merk_id-nya ada di daftar ID Merk
        // $models = HpModel::whereIn('hp_merk_id', $merkIds)->get();

    
        return DataTables::of($merks)
            // ->addColumn('action', function ($teknisi) {
            //     return '<a href="/teknisi/edit/'.$teknisi->id.'" class="btn btn-sm btn-primary">Edit</a>';
            // })
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
    public function merkStore(Request $request)
    {
        $auth = Auth::user();
        $validated = $request->validate([
            'merk' => 'required|string|min:3',
        ]);        
        $validated['user_id'] = $auth->id;
        hpMerk::create($validated);
        return redirect()->back()->with('success', 'Data Merk Hp berhasil ditambahkan!');;;
    }
    public function modelStore(Request $request)
    {

        $validated = $request->validate([
            'hp_merk_id' => 'required',
            'model' => 'required|string|min:3',
        ]);        
        hpModel::create($validated);
        return redirect()->back()->with('success', 'Data Model Hp berhasil ditambahkan!');;;
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
