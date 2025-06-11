<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Cabang;
use App\Models\sparepart_booking;
use App\Models\detailBooking;
use App\Models\booking;
use App\Models\customer;
use App\Models\dataService;
use App\Models\sparepart;
use App\Models\teknisi;
use App\Models\rating;
use App\Models\hpModel;
use Illuminate\Support\Facades\DB;

class DashboardAdmin extends Component
{
    //'cabangs','cabangNama','servisThisYear','sparepartThisYear','servisSales','sparepartSales','totalCustomers', 'totalServices', 'totalSpareparts', 'teknisis', 'exMonths', 'bookings', 'rating', 'ratingCounts','pendapatan_sparepart','pendapatan_servis','total_pendapatan','serviceMost10Data2D','hpModelTotalDataList','customerTotalDataList2D'
    public $cabangs;
    public $cabangNama;
    public $servisThisYear;
    public $sparepartThisYear;
    public $servisSales = [];
    public $sparepartSales = [];
    public $totalCustomers;
    public $totalServices;
    public $totalSpareparts;
    public $teknisis;
    public $exMonths;
    public $bookings;
    public $rating;
    public $ratingCounts;
    public $pendapatan_sparepart;
    public $pendapatan_servis;
    public $total_pendapatan;
    public $serviceMost10Data2D = [];
    public $hpModelTotalDataList;
    public $customerTotalDataList2D;
    public $selectedCabang = 'Semua Cabang';


    public function mount()
    {
                //GET ALL CABANG DATA
                $this->cabangs = cabang::all();
                $selectedCabang =  cabang::where('nama', $this->selectedCabang)->first();
                $cabangId = $selectedCabang ? $selectedCabang->user_id : null;
                $cabangIdTeknisi =  $selectedCabang ? $selectedCabang->id : null;
                $this->cabangNama = $selectedCabang ? $selectedCabang->nama : null;
                
                //ALL MONTH YEARS
                $this->exMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                $tahun = now()->year;
        
                //DATA SPAREPART
                $sparepart = sparepart_booking::whereHas('booking', function ($query) use ($cabangId) {
                    if ($cabangId) {
                    $query->where('user_id', $cabangId);
                    }
                })->get();
        
                $this->pendapatan_sparepart = $sparepart->sum('harga');
        
        
                //GET ALL SPARPART REVENUE MONTHS
                $sparepartMonths = $sparepart->groupBy(function($date) {
                    return \Carbon\Carbon::parse($date->created_at)->format('M-Y');
                })->filter(function($group, $key) {
                    return \Carbon\Carbon::createFromFormat('M-Y', $key)->year == now()->year;
                });
        
                
                
                foreach ($this->exMonths as $month) {
                    $month = $month.'-'.$tahun;
                    $this->sparepartSales[] = $sparepartMonths->has($month) ? $sparepartMonths[$month]->sum('harga') : 0;
                }
        
                $this->sparepartThisYear = array_sum($this->sparepartSales);
        
        
        
                // DATA SERVIS
                $servis = detailBooking::whereHas('booking', function ($query) use ($cabangId) {
                    if ($cabangId) {
                    $query->where('user_id', $cabangId);
                    }
                })->get();
        
                $this->pendapatan_servis = $servis->sum('harga');
                
               
                $servisMonths = $servis->groupBy(function($date) {
                    return \Carbon\Carbon::parse($date->created_at)->format('M-Y');
                })->filter(function($group, $key) {
                    return \Carbon\Carbon::createFromFormat('M-Y', $key)->year == now()->year;
                });
        
            
               
                foreach ($this->exMonths as $month) {
                    $month = $month.'-'.$tahun;
                    $this->servisSales[] = $servisMonths->has($month) ? $servisMonths[$month]->sum('harga') : 0;
                }
        
                $this->servisThisYear = array_sum($this->servisSales);
        
        
        
                //GET ALL TOTAL ITEM BOOKINGS, SERVICE, SPAREPART, TEKNISI
                $this->bookings = booking::with(['sparepart_booking', 'detailBooking'])->get();
                $this->totalCustomers = customer::when($cabangId, function ($query) use ($cabangId) {
                    return $query->where('user_id', $cabangId);
                })->get();
        
        
                $this->total_pendapatan = $this->pendapatan_sparepart + $this->pendapatan_servis;
        
                $this->totalServices = dataService::when($cabangId, function ($query) use ($cabangId) {
                    return $query->where('user_id', $cabangId);
                })->get();
        
                $this->totalSpareparts = sparepart::when($cabangId, function ($query) use ($cabangId) {
                    return $query->where('user_id', $cabangId);
                })->get();
        
                $this->teknisis = teknisi::when($cabangIdTeknisi, function ($query) use ($cabangIdTeknisi) {
                    return $query->where('cabang_id', $cabangIdTeknisi);
                })->get();
        
        
                //GET ALL RATING
                $ratings_per_id = rating::select()
                ->select('user_id', DB::raw('AVG(rating) as average_rating'))
                ->groupBy('user_id')
                ->get();
        
                $teknisis_rating = $this->teknisis->map(function ($teknisi) use ($ratings_per_id) {
                  
                    $rating = $ratings_per_id->firstWhere('user_id', $teknisi->user_id);
                 
                    $teknisi->average_rating = $rating ? $rating->average_rating : 0; // Default to 0 if no rating
                    
                    return $teknisi;
                });
        
                $ratings = rating::where('user_id', auth()->id())->get();
         
                $this->rating = round($ratings->avg('rating'), 1);
        
                $ratingCounts = rating::where('user_id', auth()->id())
                    ->selectRaw('rating, COUNT(*) as total')
                    ->groupBy('rating')
                    ->pluck('total', 'rating');
        
                $this->ratingCounts = $ratingCounts->toArray();
        
        
        
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
            
                $dataListServiceMost10 = [];
                foreach ($mostOrderedServices as $service) {
                    $dataListServiceMost10[] = [
                        'service_id' => $service->data_service_id,
                        'service_name' => dataService::find($service->data_service_id)->nama_servis ?? 'Unknown', // Getting service name
                        'total_orders' => $service->total_orders,
                    ];
                }
                $this->serviceMost10Data2D = [
                    array_column($dataListServiceMost10, 'service_name'),
                    array_column($dataListServiceMost10, 'total_orders')
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
                $this->hpModelTotalDataList = [
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
                $this->customerTotalDataList2D = [
                    $customerNames,
                    $customerTotals
                ];
             

    }



    public function render()
    {
        return view('livewire.admin.dashboard-admin');
    }
}
