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
use App\Models\hpModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class DashboardController extends Controller
{
    public function index(Request $request)
    {


        // dd($request->all());
        $exMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $tahun = now()->year;
        // Data Sparepart

        $sparepart = sparepart_booking::whereHas('booking', function ($query) {
            $query->where('user_id', auth()->id());
        });

         if ($request->has('date_range') && $request->date_range) {
            $dates = explode(' - ', $request->date_range);
            if (count($dates) === 2) {
                $startDate = $dates[0] ;
                $endDate = $dates[1];

                $sparepart->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);

                
            }
          
        }

        

        $sparepart = $sparepart->get();


        $pendapatan_sparepart = $sparepart->sum('harga');



        $sparepartMonths = $sparepart->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('M-Y');
        })->filter(function ($group, $key) {
            return \Carbon\Carbon::createFromFormat('M-Y', $key)->year == now()->year;
        });


        $sparepartSales = [];
        foreach ($exMonths as $month) {
            $month = $month . '-' . $tahun;
            $sparepartSales[] = $sparepartMonths->has($month) ? $sparepartMonths[$month]->sum('harga') : 0;
        }

        $sparepartThisYear = array_sum($sparepartSales);



        // Data Servis

        $servis = detailBooking::whereHas('booking', function ($query) {
            $query->where('user_id', auth()->id());
        });


        if ($request->has('date_range') && $request->date_range) {
            $dates = explode(' - ', $request->date_range);
            if (count($dates) === 2) {
                $startDate = $dates[0] ;
                $endDate = $dates[1];

                $servis->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);

                
            }
          
        }

        $servis = $servis->get();

        $pendapatan_servis = $servis->sum('harga');


        $servisMonths = $servis->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('M-Y');
        })->filter(function ($group, $key) {
            return \Carbon\Carbon::createFromFormat('M-Y', $key)->year == now()->year;
        });


        $servisSales = [];
        foreach ($exMonths as $month) {
            $month = $month . '-' . $tahun;
            $servisSales[] = $servisMonths->has($month) ? $servisMonths[$month]->sum('harga') : 0;
        }

        $servisThisYear = array_sum($servisSales);



        $bookings = booking::with(['sparepart_booking', 'detailBooking'])->get();


        // GET MOST ORDERED SERVICES
        $mostOrderedServices = DetailBooking::whereHas('booking', function ($query) {

            $query->where('user_id', Auth::user()->id);
        })->select('data_service_id', DB::raw('COUNT(data_service_id) as total_orders'))
            ->groupBy('data_service_id')
            ->orderByDesc('total_orders')
            ->limit(10);

            if ($request->has('date_range') && $request->date_range) {
                $dates = explode(' - ', $request->date_range);
                if (count($dates) === 2) {
                    $startDate = $dates[0] ;
                    $endDate = $dates[1];
    
                    $mostOrderedServices->whereBetween('created_at', [
                        $startDate,
                        $endDate
                    ]);
    
                    
                }
              
            }
        $mostOrderedServices = $mostOrderedServices->get();

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


        // GET ALL TOTAL ITEM BOOKINGS, SERVICE, SPAREPART, TEKNISI

        
        $totalCustomers = customer::where('user_id', Auth::user()->id);

        $total_pendapatan = $pendapatan_sparepart + $pendapatan_servis;

        $totalServices = dataService::where('user_id', Auth::user()->id);

        $most_10_ordered_service = dataService::where('user_id', Auth::user()->id)->select('nama_servis', DB::raw('COUNT(nama_servis) as total_servis'))->groupBy('nama_servis')->orderBy('nama_servis', 'desc')->take(10)->get();

        $totalSpareparts = sparepart::where('user_id', Auth::user()->id)->get();

        // $teknisis = teknisi::where('cabang_id', Auth::user()->id);

        $cabang = cabang::where('user_id', Auth::user()->id)->pluck('id')->first();

        $teknisis = teknisi::where('cabang_id', $cabang);

        if ($request->has('date_range') && $request->date_range) {
            $dates = explode(' - ', $request->date_range);
            if (count($dates) === 2) {
                $startDate = $dates[0] ;
                $endDate = $dates[1];

                $totalCustomers->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);
                $totalServices->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);
                $teknisis->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);

                
            }
          
        }

        $totalCustomers = $totalCustomers->get();
        $totalServices = $totalServices->get();
        $teknisis = $teknisis->get();



        //GET ALL TEKNISI RATING
        $ratings_per_id = rating::select()
            ->select('user_id', DB::raw('AVG(rating) as average_rating'))
            ->groupBy('user_id')
            ->get();

        $teknisis_rating = $teknisis->map(function ($teknisi) use ($ratings_per_id) {

            $rating = $ratings_per_id->firstWhere('user_id', $teknisi->user_id);

            $teknisi->average_rating = $rating ? $rating->average_rating : 0;

            return $teknisi;
        });


        // GET MOST REQUESTED MODEL HP
        $hpModelCountsFullName = hpModel::leftJoin('bookings', 'hp_models.id', '=', 'bookings.hp_model_id')
            ->leftJoin('hp_merks', 'hp_models.hp_merk_id', '=', 'hp_merks.id')
            ->where('bookings.user_id', Auth::user()->id)
            ->select(
                DB::raw("CONCAT(hp_merks.merk, ' ', hp_models.model) as full_model_name"),
                DB::raw('COUNT(bookings.id) as total')
            )
            ->groupBy('hp_models.id', 'hp_models.model', 'hp_merks.merk');

            if ($request->has('date_range') && $request->date_range) {
                $dates = explode(' - ', $request->date_range);
                if (count($dates) === 2) {
                    $startDate = $dates[0] ;
                    $endDate = $dates[1];
    
                    $hpModelCountsFullName->whereBetween('bookings.created_at', [
                        $startDate,
                        $endDate
                    ]);
    
                    
                }
              
            }
        
        $hpModelCountsFullName = $hpModelCountsFullName->get();

        $modelNames = $hpModelCountsFullName->pluck('full_model_name')->toArray();
        $totalsModel = $hpModelCountsFullName->pluck('total')->toArray();
        $hpModelTotalDataList = [
            $modelNames,
            $totalsModel
        ];



        // GET RATING
        $ratings = rating::where('user_id', auth()->id())->get();

        $rating = round($ratings->avg('rating'), 1);

        $ratingCounts = rating::where('user_id', auth()->id())
            ->selectRaw('rating, COUNT(*) as total')
            ->groupBy('rating')
            ->pluck('total', 'rating');

        $ratingCounts = $ratingCounts->toArray();


        // GET MOST ORDERED CUSTOMER
        $customerCounts = customer::leftJoin('bookings', 'customers.id', '=', 'bookings.customer_id')
            ->select('customers.nama', DB::raw('COUNT(bookings.id) as total'))
            ->where('bookings.user_id', Auth::user()->id)
            ->groupBy('customers.id', 'customers.nama')
            ->orderByDesc('total')
            ->limit(10);

            if ($request->has('date_range') && $request->date_range) {
                $dates = explode(' - ', $request->date_range);
                if (count($dates) === 2) {
                    $startDate = $dates[0] ;
                    $endDate = $dates[1];
    
                    $customerCounts->whereBetween('bookings.created_at', [
                        $startDate,
                        $endDate
                    ]);
    
                    
                }
              
            }
        $customerCounts = $customerCounts->get();

        $customerNames = $customerCounts->pluck('nama')->toArray();
        $customerTotals = $customerCounts->pluck('total')->toArray();
        $customerTotalDataList2D = [
            $customerNames,
            $customerTotals
        ];


        // Get Range Data
        

        return view('customer-service/dashboard/dashboard', compact('servisThisYear', 'sparepartThisYear', 'servisSales', 'sparepartSales', 'totalCustomers', 'totalServices', 'totalSpareparts', 'teknisis', 'exMonths',  'bookings', 'rating', 'ratingCounts', 'pendapatan_sparepart', 'pendapatan_servis', 'total_pendapatan', 'serviceMost10Data2D', 'hpModelTotalDataList', 'customerTotalDataList2D'));
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
