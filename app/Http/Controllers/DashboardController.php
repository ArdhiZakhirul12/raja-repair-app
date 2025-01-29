<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\teknisi;
use App\Models\customer;
use App\Models\dataService;
use App\Models\sparepart;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = customer::where('user_id',Auth::user()->id)->get();
        $totalServices = dataService::where('user_id',Auth::user()->id)->get();
        $totalSpareparts = sparepart::where('user_id',Auth::user()->id)->get();
        $teknisis = teknisi::where('user_id',Auth::user()->id)->get();

        return view('customer-service/dashboard/dashboard', compact('totalCustomers', 'totalServices', 'totalSpareparts','teknisis'));
    }

    /**
     * Displays the analytics screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function analytics()
    {
        // return view('pages/dashboard/analytics');
    }

    /**
     * Displays the fintech screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fintech()
    {
        // return view('pages/dashboard/fintech');
    }
}
