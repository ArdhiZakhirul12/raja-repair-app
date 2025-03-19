<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rating;
use App\Models\sparepart_booking;
use App\Models\detailBooking;
use App\Models\dataService;
use App\Models\booking;
use App\Models\customer;
use App\Models\sparepart;
use Illuminate\Support\Facades\Auth;
use App\Models\teknisi;
use Illuminate\Support\Facades\DB;
use App\Models\cabang;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cabangs = cabang::all();
        $exMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $tahun = now()->year;
        // Data Sparepart

        $sparepart = sparepart_booking::all();

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

        $servis = detailBooking::all();

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
        $totalCustomers = customer::all();


        $total_pendapatan = $pendapatan_sparepart + $pendapatan_servis;


        $totalServices = dataService::all();
        $totalSpareparts = sparepart::all();
        $teknisis = teknisi::all();


        // $teknisis = teknisi::where('cabang_id', Auth::user()->id)->get();
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
        return view('admin.dashboard.index', compact('cabangs','servisThisYear','sparepartThisYear','servisSales','sparepartSales','totalCustomers', 'totalServices', 'totalSpareparts', 'teknisis', 'exMonths', 'phoneBrands', 'brandPercentages', 'bookings', 'rating', 'ratingCounts','pendapatan_sparepart','pendapatan_servis','total_pendapatan'));
   
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
