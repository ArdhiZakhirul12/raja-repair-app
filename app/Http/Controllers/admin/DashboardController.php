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
use App\Models\hpModel;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cabangs = cabang::all();
        $selectedCabang =  cabang::where('nama', $request->query('cabang'))->first();
        $cabangId = $selectedCabang ? $selectedCabang->user_id : null;
        $cabangIdTeknisi =  $selectedCabang ? $selectedCabang->id : null;
        $cabangNama = $selectedCabang ? $selectedCabang->nama : null;
        // dd($cabangId);
        $exMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $tahun = now()->year;
        // Data Sparepart

        $sparepart = sparepart_booking::whereHas('booking', function ($query) use ($cabangId) {
            if ($cabangId) {
            $query->where('user_id', $cabangId);
            }
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

        $servis = detailBooking::whereHas('booking', function ($query) use ($cabangId) {
            if ($cabangId) {
            $query->where('user_id', $cabangId);
            }
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



        $bookings = booking::with(['sparepart_booking', 'detailBooking'])->get();
        $totalCustomers = customer::when($cabangId, function ($query) use ($cabangId) {
            return $query->where('user_id', $cabangId);
        })->get();


        $total_pendapatan = $pendapatan_sparepart + $pendapatan_servis;

        $totalServices = dataService::when($cabangId, function ($query) use ($cabangId) {
            return $query->where('user_id', $cabangId);
        })->get();

        $totalSpareparts = sparepart::when($cabangId, function ($query) use ($cabangId) {
            return $query->where('user_id', $cabangId);
        })->get();

        $teknisis = teknisi::when($cabangIdTeknisi, function ($query) use ($cabangIdTeknisi) {
            return $query->where('cabang_id', $cabangIdTeknisi);
        })->get();


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



        // GET MOST ORDERED SERVICES
        $mostOrderedServices = DetailBooking::whereHas('booking', function ($query) use ($cabangId) {
            if ($cabangId) {
            $query->where('user_id', $cabangId);
            }
        })->select('data_service_id', DB::raw('COUNT(data_service_id) as total_orders'))
        ->groupBy('data_service_id')
        ->orderByDesc('total_orders')
        ->limit(10)
        ->get();
    
        $serviceMost10Data = [];
        foreach ($mostOrderedServices as $service) {
            $serviceMost10Data[] = [
                'service_id' => $service->data_service_id,
                'service_name' => dataService::find($service->data_service_id)->nama_servis ?? 'Unknown', // Getting service name
                'total_orders' => $service->total_orders,
            ];
        }
        $serviceMost10Data2D = [
            array_column($serviceMost10Data, 'service_name'),
            array_column($serviceMost10Data, 'total_orders')
                ];



   
 
     

        // GET MOST ORDERED models

        $hpModelCountsFullName = hpModel::leftJoin('bookings', 'hp_models.id', '=', 'bookings.hp_model_id')
            ->leftJoin('hp_merks', 'hp_models.hp_merk_id', '=', 'hp_merks.id') 
            ->select(
                DB::raw("CONCAT(hp_merks.merk, ' ', hp_models.model) as full_model_name"), 
                DB::raw('COUNT(bookings.id) as total')
            )
            ->when($cabangId, function ($query) use ($cabangId) {
                return $query->where('bookings.user_id', $cabangId);
            })
            ->groupBy('hp_models.id', 'hp_models.model', 'hp_merks.merk')
            ->get();

        $modelNames = $hpModelCountsFullName->pluck('full_model_name')->toArray();
        $totalsModel = $hpModelCountsFullName->pluck('total')->toArray();
        $hpModelTotalDataList = [
            $modelNames,
            $totalsModel
        ];


        // GET MOST ORDERED CUSTOMER
        $customerCounts = customer::leftJoin('bookings', 'customers.id', '=', 'bookings.customer_id')
            ->select('customers.nama', DB::raw('COUNT(bookings.id) as total'))
            ->when($cabangId, function ($query) use ($cabangId) {
                return $query->where('bookings.user_id', $cabangId);
            })
            ->groupBy('customers.id', 'customers.nama')
            ->orderByDesc('total')
            ->limit(10)
            ->get();
        $customerNames = $customerCounts->pluck('nama')->toArray();
        $customerTotals = $customerCounts->pluck('total')->toArray();
        $customerTotalDataList2D = [
            $customerNames,
            $customerTotals
        ];
     

        return view('admin.dashboard.index', compact('cabangs','cabangNama','servisThisYear','sparepartThisYear','servisSales','sparepartSales','totalCustomers', 'totalServices', 'totalSpareparts', 'teknisis', 'exMonths', 'bookings', 'rating', 'ratingCounts','pendapatan_sparepart','pendapatan_servis','total_pendapatan','serviceMost10Data2D','hpModelTotalDataList','customerTotalDataList2D'));
   
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
