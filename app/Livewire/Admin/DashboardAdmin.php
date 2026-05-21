<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\cabang;
use App\Models\sparepart_booking;
use App\Models\detailBooking;
use App\Models\detailSale;
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
    public $hpModelTotalDataList = [];
    public $customerTotalDataList2D;
    public $selectedCabang = 'Semua Cabang';
    public $selectedDateRange;


    public function mount($id,$dateRange,$cabang)
    {

        // $this->selectedCabang = $cabang ? $cabang : 'Semua Cabang';
        $clearValue = str_replace('Cabang ', '', $cabang);
        $this->selectedCabang = $clearValue;
        $selectedCabang = cabang::where('nama', $clearValue)->first();
        $this->cabangNama = $selectedCabang ? $selectedCabang->nama : null;
        $this->selectedDateRange = $dateRange ? $dateRange : null;
        $this->initializeCabangData();
        $this->initializeMonthYears();
        $this->initializeSparepartData();
        $this->initializeServisData();
        $this->initializeTotalData();
        $this->initializeRatingData();
        $this->initializeMostOrderedServices();
        $this->initializeMostOrderedModels();
        $this->initializeMostOrderedCustomers();
    }

   

    public function updatedSelectedDateRange($value)
    {

        return redirect()->route('admin.dashboard', ['id' => 'all', 'dateRange' => $value, 'cabang' => $this->selectedCabang]);
     

    }


    public function updatedSelectedCabang($value)
    {
        return redirect()->route('admin.dashboard', ['id' => 'all', 'dateRange' => $this->selectedDateRange, 'cabang' => $value]);
        // $this->initializeSparepartData();
        // $this->initializeServisData();
        // $this->initializeTotalData();
        // $this->initializeRatingData();
        // $this->initializeMostOrderedServices();
        // $this->initializeMostOrderedModels();
        // $this->initializeMostOrderedCustomers();
        // $this->dispatchBrowserEvent('updateChartData', [
        //     'months' => $this->exMonths,
        //     'sales' => $this->servisSales,
        // ]); 
    }

    private function initializeCabangData()
    {
        $this->cabangs = cabang::all();
        $selectedCabang = cabang::where('nama', $this->selectedCabang)->first();
        $this->cabangNama = $selectedCabang ? $selectedCabang->nama : null;
    }

    private function initializeMonthYears()
    {
        $this->exMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    }

    private function initializeSparepartData()
    {
        $selectedCabang = cabang::where('nama', $this->selectedCabang)->first();
        $cabangId = $selectedCabang ? $selectedCabang->user_id : null;

        $sparepart = sparepart_booking::whereHas('booking', function ($query) use ($cabangId) {
            if ($cabangId) {
                $query->where('user_id', $cabangId);
            }
        });
        $sparepartSale = detailSale::whereHas('sparepartSale', function ($query) use ($cabangId) {
            if ($cabangId) {
                $query->where('user_id', $cabangId);
            }
        });

        if ($this->selectedDateRange != null && $this->selectedDateRange != '') {
            $dates = explode(' to ', $this->selectedDateRange);
            if (count($dates) === 2) {
                $startDate = $dates[0];
                $endDate = $dates[1];
                $sparepart->whereHas('booking', function ($query) use ($startDate, $endDate) {
                    $query->where('status', 'selesai')
                          ->whereBetween('created_at', [$startDate, $endDate]);
                });
                $sparepartSale->whereHas('sparepartSale', function ($query) use ($startDate, $endDate) {
                    $query->where('status', 'selesai')
                          ->whereBetween('created_at', [$startDate, $endDate]);
                });
                // dd($startDate,$endDate);
            }
        }

        

        $sparepart = $sparepart->get();
        $sparepartSale = $sparepartSale->get();
 

    
        $this->pendapatan_sparepart = $sparepart->sum('harga') + $sparepartSale->sum('harga');

        $sparepartMonths = sparepart_booking::whereHas('booking', function ($query) use ($cabangId) {
            if ($cabangId) {
                $query->where('user_id', $cabangId);
            }
        })->get()->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('M-Y');
        })->filter(function ($group, $key) {
            return \Carbon\Carbon::createFromFormat('M-Y', $key)->year == now()->year;
        });
        $sparepartSaleMonths = detailSale::whereHas('sparepartSale', function ($query) use ($cabangId) {
            if ($cabangId) {
                $query->where('user_id', $cabangId);
            }
        })->get()->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('M-Y');
        })->filter(function ($group, $key) {
            return \Carbon\Carbon::createFromFormat('M-Y', $key)->year == now()->year;
        });

        
        if ($this->selectedDateRange != null && $this->selectedDateRange != '') {
            $dates = explode(' to ', $this->selectedDateRange);
            $tahun = \Carbon\Carbon::parse($dates[0])->year;
            
        }else{
            $tahun = now()->year;
        }
        $this->sparepartSales = [];
        foreach ($this->exMonths as $month) {
            $month = $month . '-' . $tahun;
            $sparepartBookingTotal = $sparepartMonths->has($month) ? $sparepartMonths[$month]->sum('harga') : 0;
            $sparepartSaleTotal = $sparepartSaleMonths->has($month) ? $sparepartSaleMonths[$month]->sum('harga') : 0;
            $this->sparepartSales[] = $sparepartBookingTotal + $sparepartSaleTotal;
            // if($sparepartMonths->has($month) && $this->selectedDateRange != null && $this->selectedDateRange != ''){
            //     dd($sparepartMonths[$month]->sum('harga'), $sparepartMonths[$month]);
            // }
        }

        $this->sparepartThisYear = array_sum($this->sparepartSales);
        
        // if ($this->selectedDateRange != null && $this->selectedDateRange != '') {
        //     dd($tahun,$sparepartMonths,$this->sparepartSales, $this->sparepartThisYear, $this->pendapatan_sparepart);
        // }
    }

    private function initializeServisData()
    {
        $selectedCabang = cabang::where('nama', $this->selectedCabang)->first();
        $cabangId = $selectedCabang ? $selectedCabang->user_id : null;

        $servis = detailBooking::whereHas('booking', function ($query) use ($cabangId) {
            if ($cabangId) {
            $query->where('user_id', $cabangId);
            }
        });

        if ($this->selectedDateRange != null && $this->selectedDateRange != '') {
            $dates = explode(' to ', $this->selectedDateRange);
            if (count($dates) === 2) {
            $startDate = $dates[0];
            $endDate = $dates[1];
            $servis->whereHas('booking', function ($query) use ($startDate, $endDate) {
                $query->where('status', 'selesai')
                  ->whereBetween('created_at', [$startDate, $endDate]);
            });
            }
        }
       

        $servis = $servis->get();

        $this->pendapatan_servis = $servis->sum('harga');

        $servisMonths = $servis->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('M-Y');
        })->filter(function ($group, $key) {
            return \Carbon\Carbon::createFromFormat('M-Y', $key)->year == now()->year;
        });

        $getAllservis = detailBooking::whereHas('booking', function ($query) use ($cabangId) {
            if ($cabangId) {
            $query->where('user_id', $cabangId);
            }
        })->get()->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('M-Y');
        })->filter(function ($group, $key) {
            return \Carbon\Carbon::createFromFormat('M-Y', $key)->year == now()->year;
        });

        if ($this->selectedDateRange != null && $this->selectedDateRange != '') {
            $dates = explode(' to ', $this->selectedDateRange);
            $tahun = \Carbon\Carbon::parse($dates[0])->year;
            
        }else{
            $tahun = now()->year;
        }
        $this->servisSales = [];
        foreach ($this->exMonths as $month) {
            $month = $month . '-' . $tahun;
            $this->servisSales[] = $getAllservis->has($month) ? $getAllservis[$month]->sum('harga') : 0;
        }

        $this->servisThisYear = array_sum($this->servisSales);

   
    }

    private function initializeTotalData()
    {
        $selectedCabang = cabang::where('nama', $this->selectedCabang)->first();
        $cabangId = $selectedCabang ? $selectedCabang->user_id : null;
        $cabangIdTeknisi = $selectedCabang ? $selectedCabang->id : null;

        $this->bookings = booking::with(['sparepart_booking', 'detailBooking'])->get();
        $this->totalCustomers = customer::when($cabangId, function ($query) use ($cabangId) {
            return $query->where('user_id', $cabangId);
        });

        $this->total_pendapatan = $this->pendapatan_sparepart + $this->pendapatan_servis;

        $this->totalServices = dataService::when($cabangId, function ($query) use ($cabangId) {
            return $query->where('user_id', $cabangId);
        });

        $this->totalSpareparts = sparepart::when($cabangId, function ($query) use ($cabangId) {
            return $query->where('user_id', $cabangId);
        })->get();

        $this->teknisis = teknisi::when($cabangIdTeknisi, function ($query) use ($cabangIdTeknisi) {
            return $query->where('cabang_id', $cabangIdTeknisi);
        });


        if ($this->selectedDateRange != null && $this->selectedDateRange != ''){
            $dates = explode(' to ', $this->selectedDateRange);
            if (count($dates) === 2) {
                $startDate = $dates[0] ;
                $endDate = $dates[1];

                $this->totalCustomers->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);
                $this->totalServices->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);
                // $this->teknisis->whereBetween('created_at', [
                //     $startDate,
                //     $endDate
                // ]);

                
            }
          
        }

        $this->totalCustomers = $this->totalCustomers->get();
        $this->totalServices = $this->totalServices->get();
        $this->teknisis = $this->teknisis->get();
    }

    private function initializeRatingData()
    {
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
    }

    private function initializeMostOrderedServices()
    {
        $selectedCabang = cabang::where('nama', $this->selectedCabang)->first();
        $cabangId = $selectedCabang ? $selectedCabang->user_id : null;

        $mostOrderedServices = DetailBooking::whereHas('booking', function ($query) use ($cabangId) {
            if ($cabangId) {
                $query->where('user_id', $cabangId);
            }
        })->select('data_service_id', DB::raw('COUNT(data_service_id) as total_orders'))
            ->groupBy('data_service_id')
            ->orderByDesc('total_orders')
            ->limit(10);


            if ($this->selectedDateRange != null && $this->selectedDateRange != ''){
                $dates = explode(' to ', $this->selectedDateRange);
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
    }

    private function initializeMostOrderedModels()
    {
        $selectedCabang = cabang::where('nama', $this->selectedCabang)->first();
        $cabangId = $selectedCabang ? $selectedCabang->user_id : null;

        $hpModelCountsFullName = hpModel::leftJoin('bookings', 'hp_models.id', '=', 'bookings.hp_model_id')
            ->leftJoin('hp_merks', 'hp_models.hp_merk_id', '=', 'hp_merks.id')
            ->select(
                DB::raw("CONCAT(hp_merks.merk, ' ', hp_models.model) as full_model_name"),
                DB::raw('COUNT(bookings.id) as total')
            )
            ->when($cabangId, function ($query) use ($cabangId) {
                return $query->where('bookings.user_id', $cabangId);
            })
            ->groupBy('hp_models.id', 'hp_models.model', 'hp_merks.merk');

            if ($this->selectedDateRange != null && $this->selectedDateRange != '') {
                $dates = explode(' to ', $this->selectedDateRange);
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
        $this->hpModelTotalDataList = [
            $modelNames,
            $totalsModel
        ];
 
    }

    private function initializeMostOrderedCustomers()
    {
        $selectedCabang = cabang::where('nama', $this->selectedCabang)->first();
        $cabangId = $selectedCabang ? $selectedCabang->user_id : null;

        $customerCounts = customer::leftJoin('bookings', 'customers.id', '=', 'bookings.customer_id')
            ->select('customers.nama', DB::raw('COUNT(bookings.id) as total'))
            ->when($cabangId, function ($query) use ($cabangId) {
                return $query->where('bookings.user_id', $cabangId);
            })
            ->groupBy('customers.id', 'customers.nama')
            ->orderByDesc('total')
            ->limit(10);

            if ($this->selectedDateRange != null && $this->selectedDateRange != '') {
                $dates = explode(' to ', $this->selectedDateRange);
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
