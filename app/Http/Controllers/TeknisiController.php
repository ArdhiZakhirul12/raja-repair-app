<?php

namespace App\Http\Controllers;

use App\Models\teknisi;
use App\Models\booking;
use App\Models\rating;
use App\Models\User;
use App\Models\claimGaransi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class TeknisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teknisis = teknisi::where('user_id', Auth::user()->id)->get();

        return view('customer-service.teknisi.list');
    }


    /**
     * Get all service data
     */
    public function getTechnicians()
    {
        $teknisis = teknisi::where('cabang_id', Auth::user()->cabang->id)->get();

        return DataTables::of($teknisis)
            // ->addColumn('action', function ($teknisi) {
            //     return '<a href="/teknisi/edit/'.$teknisi->id.'" class="btn btn-sm btn-primary">Edit</a>';
            // })
            ->rawColumns(['action'])
            ->make(true);
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
        $auth = Auth::user()->cabang->id;
        $cabang_id = $auth;

        // dd($cabang_id);
        $validated = $request->validate([
            'nama' => 'required|string|min:3',
            'no_hp' => 'required|numeric|digits_between:11,13',
            'alamat' => 'nullable',
            'email' => 'required|email',
        ]);
        $user = User::create([
            'name' => $validated['nama'],
            'email'=> $validated['email'],
            'password' => Hash::make('password')
        ]);
        $user->assignRole('teknisi');

        teknisi::create([
            'user_id' => $user->id,
            'cabang_id' => $cabang_id,
            'no_hp' => $validated['no_hp'],
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat']
        ]);
        return redirect()->back()->with('success', 'berhasil menambahkan data teknisi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id , Request $request)
    {

        $bookings = booking::with('detailBooking')->where('teknisi_id', $id)->where('status', 'selesai');
        $teknisi = teknisi::find($id);
        // mendapatkan booking yang bergaransi
        $garansi = booking::whereHas('claimGaransi')->where('teknisi_id', $id);

        $teknisi_id = teknisi::where('id', $id)->first()->user_id;

        $rating_all = rating::where('user_id', $teknisi_id);

        $data = booking::with('detailBooking')
        ->select(booking::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan, COUNT(id) as jumlah_servis"))
        ->where('teknisi_id', $id)
        ->groupBy('bulan')
        ->orderBy('bulan', 'asc');
        

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
                $rating_all->whereBetween('created_at', [
                    $startDate,
                    $endDate
                ]);

                
            }
        }

        $data = $data->get();
        $bookings = $bookings->get();
        $garansi = $garansi->get();
        $rating_all = $rating_all->get();
        
        
    
        
    $ratingCounts = $rating_all->groupBy('rating')->map(function ($group) {
        return $group->count();
    });

    // Ensure all ratings (1, 2, 3) are present, even if they have 0 count
    foreach ([1, 2, 3] as $rating) {
        if (!$ratingCounts->has($rating)) {
            $ratingCounts[$rating] = 0;
        }
    }
    //    dd($ratingCounts);
        $ratings_per_id = rating::select('user_id', DB::raw('AVG(rating) as average_rating'))
        ->groupBy('user_id')
        ->where('id', $id)
        ->first();

        // dd($ratings_per_id);


        // Konversi data ke format array untuk chart
        $bulanLabels = $data->pluck('bulan')->toArray();
        $jumlahServis = $data->pluck('jumlah_servis')->toArray();


        // dd($garansi);


        // untuk mendapatkan total service dari teknisi
        $total = 0;
        foreach ($bookings as $booking) {
            foreach ($booking->detailBooking as $detail) {
                $total = $detail->harga + $total;
            }
        }

        return view('customer-service.teknisi.detail', compact('bookings', 'garansi', 'total', 'teknisi', 'bulanLabels', 'jumlahServis','ratingCounts','ratings_per_id'));

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
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|min:3',
            'no_hp' => 'required|numeric|digits_between:11,13',
            'alamat' => 'required|min:3',
        ]);

        teknisi::where('id', $request->id)->update($validated);
        return redirect()->back()->with('msg', 'berhasil mengedit Teknisi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function bookingTeknisi(String $id)
    {
        
        // $bookings = booking::where('teknisi_id', $id)->get();

        return view('customer-service.teknisi.booking-teknisi', compact( 'id'));
    }

    public function getBookingTeknisi(String $id)
    {
        $bookings = booking::with(['hpModel', 'user', 'detailBooking', 'customer'])->where('teknisi_id', $id)->where('status', 'selesai')->get();
        return DataTables::of($bookings)
            // ->addColumn('action', function ($teknisi) {
            //     return '<a href="/teknisi/edit/'.$teknisi->id.'" class="btn btn-sm btn-primary">Edit</a>';
            // })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function claimTeknisi(String $id)
    {
        return view('customer-service.teknisi.claim-teknisi',compact('id'));
    }

    public function getClaimTeknisi(String $id)
    {
        $booking = booking::where('teknisi_id', $id)->get();
        $garansi = claimGaransi::with('booking','booking.customer')->whereIn('booking_id', $booking->pluck('id'))->get();

        return DataTables::of($garansi)
            ->rawColumns(['action'])
            ->make(true);
    }
}
