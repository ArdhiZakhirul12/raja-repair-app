<?php

namespace App\Http\Controllers;

use App\Models\teknisi;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;


class TeknisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        // $teknisis = teknisi::where('user_id',Auth::user()->id)->get();

        return view('customer-service.teknisi.list');
    }


              /**
     * Get all service data
     */
    public function getTechnicians()
    {
        $teknisis = teknisi::where('user_id',Auth::user()->id)->get();
    
        return DataTables::of($teknisis)
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
    public function store(Request $request)
    {
        $auth = Auth::user();
        $validated = $request->validate([
            'nama' => 'required|string|min:3',
            'no_hp' => 'required|numeric|digits_between:11,13',
            'alamat' => 'nullable',
        ]);        
        $validated['user_id'] = $auth->id;
        teknisi::create($validated);
        return redirect()->back()->with('success','berhasil menambahkan data teknisi');
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
            'nama' => 'required|string|min:3',
            'no_hp' => 'required|numeric|digits_between:11,13',
            'alamat' => 'required|min:3',            
        ]); 
        
        teknisi::where('id', $request->id)->update($validated);
        return redirect()->back()->with('msg','berhasil mengedit Teknisi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
