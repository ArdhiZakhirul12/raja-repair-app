<?php

namespace App\Http\Controllers;

use App\Models\pengeluaran;
use Illuminate\Http\Request;


class SpendingController extends Controller
{
    public function create()
    {

        // $services = dataService::where('user_id',Auth::user()->id)->get();

        return view('customer-service.spending.spending');
    }

    public function index()
    {
        $spendings = pengeluaran::where('user_id', auth()->id())->get();
        return view('customer-service.spending.detail',compact('spendings'));
    }

    //
}
