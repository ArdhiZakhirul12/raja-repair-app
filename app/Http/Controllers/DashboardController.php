<?php

namespace App\Http\Controllers;

use App\Models\rating;
use Illuminate\Http\Request;
use App\Models\booking;
use App\Models\cabang;
use App\Models\teknisi;
use App\Models\customer;
use App\Models\dataService;
use App\Models\detailBooking;
use App\Models\sparepart;
use App\Models\sparepart_booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class DashboardController extends Controller
{
    public function index()
    {

        $exMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $tahun = now()->year;
        // Data Sparepart

        $sparepart = sparepart_booking::whereHas('booking', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

        $pendapatan_sparepart = $sparepart->sum('harga');


               
        $sparepartMonths = $sparepart->groupBy(function($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('M-Y');
        })->filter(function($group, $key) {
            return \Carbon\Carbon::createFromFormat('M-Y', $key)->year == now()->year;
        });

        
        $sparepartSales = [];
        foreach ($exMonths as $month) {
            $month = $month.'-'.$tahun;
            $sparepartSales[] = $sparepartMonths->has($month) ? $sparepartMonths[$month]->sum('harga') : 0;
        }

        $sparepartThisYear = array_sum($sparepartSales);



        // Data Servis

        $servis = detailBooking::whereHas('booking', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

        $pendapatan_servis = $servis->sum('harga');
        
       
        $servisMonths = $servis->groupBy(function($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('M-Y');
        })->filter(function($group, $key) {
            return \Carbon\Carbon::createFromFormat('M-Y', $key)->year == now()->year;
        });

    
        $servisSales = [];
        foreach ($exMonths as $month) {
            $month = $month.'-'.$tahun;
            $servisSales[] = $servisMonths->has($month) ? $servisMonths[$month]->sum('harga') : 0;
        }

        $servisThisYear = array_sum($servisSales);


   

        $phoneBrands = ['Samsung', 'Apple', 'Huawei', 'Xiaomi', 'Oppo', 'Vivo', 'OnePlus', 'Nokia', 'Sony', 'LG'];
        $brandPercentages = [20, 15, 10, 12, 8, 7, 5, 6, 9, 8];

        $technicianNames = ['John Doe', 'Jane Smith', 'Michael Johnson', 'Emily Davis', 'David Wilson', 'bagio', 'budi', 'susi', 'joko', 'joni'];
        $serviceAmounts = [30, 25, 40, 35, 20, 15, 10, 5, 3, 2];


        $bookings = booking::with(['sparepart_booking', 'detailBooking'])->get();
        $totalCustomers = customer::where('user_id', Auth::user()->id)->get();


        $total_pendapatan = $pendapatan_sparepart + $pendapatan_servis;


        $totalServices = dataService::where('user_id', Auth::user()->id)->get();
        $totalSpareparts = sparepart::where('user_id', Auth::user()->id)->get();
        $teknisis = teknisi::where('cabang_id', Auth::user()->id)->get();

        $cabang = cabang::where('user_id', Auth::user()->id)->pluck('id')->first();
        $teknisis = teknisi::where('cabang_id', $cabang)->get();
        // dd($teknisis,$cabang);
        $ratings_per_id = rating::select()
        ->select('user_id', DB::raw('AVG(rating) as average_rating'))
        ->groupBy('user_id')
        ->get();

        $teknisis_rating = $teknisis->map(function ($teknisi) use ($ratings_per_id) {
          
            $rating = $ratings_per_id->firstWhere('user_id', $teknisi->user_id);
         
            $teknisi->average_rating = $rating ? $rating->average_rating : 0; // Default to 0 if no rating
            
            // $teknisi->average_rating = $ratings_per_id[$teknisi->user_id] ?? 0; // Default to 0 if no rating
            return $teknisi;
        });

      

        $ratings = rating::where('user_id', auth()->id())->get();
 
    
        $rating = round($ratings->avg('rating'), 1);

        $ratingCounts = rating::where('user_id', auth()->id())
            ->selectRaw('rating, COUNT(*) as total')
            ->groupBy('rating')
            ->pluck('total', 'rating');

        $ratingCounts = $ratingCounts->toArray();
        return view('customer-service/dashboard/dashboard', compact('servisThisYear','sparepartThisYear','servisSales','sparepartSales','totalCustomers', 'totalServices', 'totalSpareparts', 'teknisis', 'exMonths', 'phoneBrands', 'brandPercentages', 'bookings', 'rating', 'ratingCounts','pendapatan_sparepart','pendapatan_servis','total_pendapatan'));
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
