<?php

namespace App\Http\Controllers\teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\teknisi;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Concat;
use App\Models\Booking;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teknisi_data = teknisi::where('user_id', Auth::user()->id)->first();
        $id = Auth::user()->id;
        $data = booking::with('detailBooking')
            ->select(booking::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan, COUNT(id) as jumlah_servis"))
            ->where('teknisi_id', $id)
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        // dd($data);

        // Konversi data ke format array untuk chart
        $bulanLabels = $data->pluck('bulan')->toArray();
        $jumlahServis = $data->pluck('jumlah_servis')->toArray();

        $bookings = booking::with('detailBooking', 'claimGaransi')->where('teknisi_id', $teknisi_data->id)->where('status', 'selesai')->get();


        $garansi = $bookings->sum(
            fn($booking) =>
            $booking->claimGaransi->where('status', 'selesai')->count()
        );
        $totalBooking = $bookings->count() + $garansi;



        // untuk mendapatkan total service dari teknisi
        $total = 0;
        foreach ($bookings as $booking) {
            foreach ($booking->detailBooking as $detail) {
                $total = $detail->harga + $total;
            }
        }



        return view('teknisi.dashboard.teknisi-dashboard', compact('teknisi_data', 'bookings', 'garansi', 'total', 'bulanLabels', 'jumlahServis', 'totalBooking'));

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
