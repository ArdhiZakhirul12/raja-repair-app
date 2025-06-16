<?php

namespace App\Http\Controllers;

use App\Models\pengeluaran;
use App\Models\detailBooking;
use App\Models\sparepart_booking;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class SpendingController extends Controller
{
    public function create()
    {

        // $services = dataService::where('user_id',Auth::user()->id)->get();

        return view('customer-service.spending.spending');
    }

    public function index(Request $request)
    {

        
        $sparepart = sparepart_booking::whereHas('booking', function ($query) {
            $query->where('user_id', auth()->id());
        });

        $servis = detailBooking::whereHas('booking', function ($query) {
            $query->where('user_id', auth()->id());
        });

        

        $total_pengeluaran = pengeluaran::where('user_id', auth()->id());
        $spendings = pengeluaran::where('user_id', auth()->id());
        
        if ($request->has('date_range') && $request->date_range) {

            $dates = explode(' - ', $request->date_range);
            
            if (count($dates) === 2) {
                $startDate = date('Y-m-d', strtotime($dates[0]));
                $endDate = date('Y-m-d', strtotime($dates[1]));
               
                $sparepart->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);
                $servis->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);
                $total_pengeluaran->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);
                $spendings->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);

                
            }
        }

        $sparepart = $sparepart->sum('harga');
        $servis = $servis->sum('harga');
        $total_pengeluaran = $total_pengeluaran->sum('harga');
        $spendings =$spendings->get();

        $total_pendapatan = $sparepart + $servis;
        $pendapatan_bersih = $total_pendapatan - $total_pengeluaran;
        return view('customer-service.spending.list',compact('total_pendapatan','total_pengeluaran','pendapatan_bersih'));
    }

    public function getSpendings(Request $request)
    {
        $spendings = pengeluaran::where('user_id', auth()->id());

        if ($request->has('date_range') && $request->date_range) {

            $dates = explode(' - ', $request->date_range);
            
            if (count($dates) === 2) {
                $startDate = date('Y-m-d', strtotime($dates[0]));
                $endDate = date('Y-m-d', strtotime($dates[1]));

                
                $spendings->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);


            }
        }

        $spendings = $spendings->get();
    
        return DataTables::of($spendings)
   
            ->rawColumns(['action'])
            ->make(true);

    }

    public function show($id){
        $spending = pengeluaran::find($id);
        return view('customer-service.spending.detail', compact('spending'));
    }

    //
}
