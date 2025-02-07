<?php

namespace App\Http\Controllers;

use App\Models\pengeluaran;
use Illuminate\Http\Request;


class SpendingController extends Controller
{
    public function index()
    {

        // $services = dataService::where('user_id',Auth::user()->id)->get();

        return view('customer-service.spending.spending');
    }

    public function show()
    {
        pengeluaran::where('user_id', auth()->id());
        return view('customer-service.spending.detail',compact('pengeluaran'));
    }

    //
}
