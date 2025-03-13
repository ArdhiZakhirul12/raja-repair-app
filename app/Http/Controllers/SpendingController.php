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

    public function index()
    {

        
        $sparepart = sparepart_booking::whereHas('booking', function ($query) {
            $query->where('user_id', auth()->id());
        })->sum('harga');

        $servis = detailBooking::whereHas('booking', function ($query) {
            $query->where('user_id', auth()->id());
        })->sum('harga');

        $total_pendapatan = $sparepart + $servis;

        $total_pengeluaran = pengeluaran::where('user_id', auth()->id())->sum('harga');

        $pendapatan_bersih = $total_pendapatan - $total_pengeluaran;

        // $pendapatan_servis = $servis->sum('harga');

        // $pendapatan_sparepart = $sparepart->sum('harga');



        // $spendings = pengeluaran::where('user_id', auth()->id())->get();
        return view('customer-service.spending.list',compact('total_pendapatan','total_pengeluaran','pendapatan_bersih'));
    }

    public function getSpendings()
    {
        $spendings = pengeluaran::where('user_id', auth()->id())->get();
    
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
