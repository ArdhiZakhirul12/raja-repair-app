<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = customer::where('user_id',Auth::user()->id)->get();

        return view('customer-service.customer.list',compact('customers'));
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
            'no_hp' => ['required','numeric','digits_between:11,13',
            function ($attribute, $value, $fail) {
                // Cek apakah nomor HP mengandung angka saja
                if (!preg_match('/^08[0-9]+$/', $value)) {
                    $fail('Nomor HP harus dimulai dengan "08" dan hanya berisi angka.');
                }
            },
        ],
            'alamat' => 'nullable',
        ]);
        
        


        $validated['user_id'] = $auth->id;
        customer::create($validated);
        return redirect()->back()->with('success', 'Data pelanggan berhasil ditambahkan!');
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
