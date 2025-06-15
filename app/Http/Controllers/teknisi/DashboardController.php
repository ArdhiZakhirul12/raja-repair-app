<?php

namespace App\Http\Controllers\teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\teknisi;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Concat;
use App\Models\booking;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $teknisi_data = teknisi::where('user_id', Auth::user()->id)->first();
        $id = $teknisi_data->id;
        $garansi = booking::whereHas('claimGaransi')->where('teknisi_id', $teknisi_data->id);
        $data = booking::with('detailBooking')
            ->select(booking::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan, COUNT(id) as jumlah_servis"))
            ->where('teknisi_id', $id)
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc');

        $bookings = booking::with('detailBooking')->where('teknisi_id', $teknisi_data->id)->where('status', 'selesai');

        if ($request->has('date_range') && $request->date_range) {

            $dates = explode(' - ', $request->date_range);
            
            if (count($dates) === 2) {
                $startDate = date('Y-m-d', strtotime($dates[0]));
                $endDate = date('Y-m-d', strtotime($dates[1]));
               
                $data->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);
                $bookings->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);
                $garansi->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);
        
            }
        }

        $data = $data->get();
        $bookings = $bookings->get();
        $garansi = $garansi->get();

        // Konversi data ke format array untuk chart
        $bulanLabels = $data->pluck('bulan')->toArray();
        $jumlahServis = $data->pluck('jumlah_servis')->toArray();

       


        // $garansi = $bookings->sum(
        //     fn($booking) =>
        //     $booking->claimGaransi->where('status', 'selesai')->count()
        // );
        // $totalBooking = $bookings->count() + $garansi;



        // untuk mendapatkan total service dari teknisi
        $total = 0;
        foreach ($bookings as $booking) {
            foreach ($booking->detailBooking as $detail) {
                $total = $detail->harga + $total;
            }
        }



        return view('teknisi.dashboard.teknisi-dashboard', compact('teknisi_data', 'bookings', 'garansi', 'total', 'bulanLabels', 'jumlahServis'));

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
