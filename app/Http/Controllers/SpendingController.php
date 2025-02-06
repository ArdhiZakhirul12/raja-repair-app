<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpendingController extends Controller
{
    public function index()
    {

        // $services = dataService::where('user_id',Auth::user()->id)->get();

        return view('customer-service.spending.spending');
    }

    //
}
