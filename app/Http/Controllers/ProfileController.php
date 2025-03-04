<?php

namespace App\Http\Controllers;

use App\Models\cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Concat;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $user_cabang_id = Auth::user()->id;
        $cabang_data = cabang::where('user_id', $user_cabang_id)->first();
       
        //
        return view('customer-service.profile.profile-cabang',compact('cabang_data'));
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
