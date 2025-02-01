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
        $exMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $exSales = [100, 200, 150, 300, 250, 400];

        $phoneBrands = ['Samsung', 'Apple', 'Huawei', 'Xiaomi', 'Oppo', 'Vivo', 'OnePlus', 'Nokia', 'Sony', 'LG'];
        $brandPercentages = [20, 15, 10, 12, 8, 7, 5, 6, 9, 8];

        $technicianNames = ['John Doe', 'Jane Smith', 'Michael Johnson', 'Emily Davis', 'David Wilson','bagio','budi','susi','joko','joni'];
        $serviceAmounts = [30, 25, 40, 35, 20, 15, 10, 5, 3, 2];


        $totalCustomers = customer::where('user_id',Auth::user()->id)->get();
        $totalServices = dataService::where('user_id',Auth::user()->id)->get();
        $totalSpareparts = sparepart::where('user_id',Auth::user()->id)->get();
        $teknisis = teknisi::where('user_id',Auth::user()->id)->get();

        return view('customer-service/dashboard/dashboard', compact('totalCustomers', 'totalServices', 'totalSpareparts','teknisis','exMonths','exSales','phoneBrands','brandPercentages'));
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
