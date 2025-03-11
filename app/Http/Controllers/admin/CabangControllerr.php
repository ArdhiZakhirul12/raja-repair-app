<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\cabang;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class CabangControllerr extends Controller
{
    public function index()
    {
        return view('admin.cabang.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'nama_cabang' => 'required|string',
            'no_hp' => [
                'required',
                'numeric',
                'min:11',
                function ($attribute, $value, $fail) {
                    // Cek apakah nomor HP mengandung angka saja
                    if (!preg_match('/^08[0-9]+$/', $value)) {
                        $fail('Nomor HP harus dimulai dengan "08" dan hanya berisi angka.');
                    }
                },
            ],
            'alamat' => 'required',
            'email' => 'required|email',
            'password' => 'required | min:5'
        ]);
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('cabang');

        cabang::create([
            'user_id' => $user->id,
            'no_hp' => $request->no_hp,
            'nama' => $request->nama_cabang,
            'alamat' => $request->alamat
        ]);
        return redirect()->back()->with('success', 'Cabang Baru berhasil ditambahkan!');
    }
}
