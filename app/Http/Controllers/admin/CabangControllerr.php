<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\booking;
use App\Models\cabang;
use App\Models\dataService;
use App\Models\sparepart;
use App\Models\User;
use App\Models\teknisi;
use App\Models\pengeluaran;
use App\Models\sparepart_booking;
use App\Models\detailBooking;
// use Hash;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class CabangControllerr extends Controller
{
    public function index()
    {
        return view('admin.cabang.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'nama_cabang' => 'required|string',
            'no_hp' => [
                'required',
                'numeric',
                'min:11',
                function ($attribute, $value, $fail) {
                    // Cek apakah nomor HP mengandung angka saja
                    if (!preg_match('/^08[0-9]+$/', $value)) {
                        $fail('Nomor HP harus dimulai dengan "08" dan hanya berisi angka.');
                    }
                },
            ],
            'alamat' => 'required',
            'link_map' => 'required',
            'email' => 'required|email',
            'password' => 'required | min:5'
        ]);
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('cabang');

        cabang::create([
            'user_id' => $user->id,
            'no_hp' => $request->no_hp,
            'nama' => $request->nama_cabang,
            'alamat' => $request->alamat,
            'link_map' => $request->link_map
        ]);

        $services = dataService::all()->unique('code')->values();


        foreach ($services as $service) {
            $createService = [ 
                'user_id' => $user->id,
                'code' => $service->code,
                'nama_servis' => $service->nama_servis,
                'jenis_servis' => $service->jenis_servis,
                'harga' => $service->harga,
                'garansi_1' => $service->garansi_1,
                'garansi_2' => $service->garansi_2,
                'garansi_3' => $service->garansi_3,
                'status' => 1,
                'booking' => 0,
            ];
            dataService::create($createService);
        }
        $spareparts = sparepart::all()->unique('code')->values();

        foreach ($spareparts as $sparepart){
            $createSparepart = [
                'user_id' => $user->id,
                'code' => $sparepart->code,
                 'nama_sparepart' => $sparepart->nama_sparepart,
                'harga' => $sparepart->harga,                
                'status' => 1,
                'terjual' => 0,
            ];
            sparepart::create($createSparepart);
        }

        return redirect()->back()->with('success', 'Cabang Baru berhasil ditambahkan!');
    }
    public function getCabang()
    {
        $cabang = cabang::with('user')->get();

        return DataTables::of($cabang)
            ->rawColumns(['action'])
            ->make(true);
    }


    public function listTeknisi(Request $request)
    {
        // $teknisis = teknisi::where('user_id', Auth::user()->id)->get();
        $cabang_id = $request->id;
        return view('admin.cabang.listTeknisi', compact('cabang_id'));
    }

    public function listAdminCabangSpending(Request $request)
    {
        $cabang_id = $request->id;
        $sparepart = sparepart_booking::whereHas('booking', function ($query)use ($cabang_id) {
            $query->where('user_id', $cabang_id);
        })->sum('harga');


        $servis = detailBooking::whereHas('booking', function ($query) use ($cabang_id) {
            $query->where('user_id', $cabang_id);
        })->sum('harga');

        $total_pendapatan = $sparepart + $servis;

        $total_pengeluaran = pengeluaran::where('user_id', $cabang_id)->sum('harga');

        $pendapatan_bersih = $total_pendapatan - $total_pengeluaran;
        $spendings = pengeluaran::where('user_id', $cabang_id)->get();
        // dd($sparepart,$sparepart_data, $servis, $total_pendapatan, $total_pengeluaran, $pendapatan_bersih);
        // dd($spendings);
        // dd($total_pendapatan, $total_pengeluaran, $pendapatan_bersih, $cabang_id, $sparepart, $servis);

        return view('admin.cabang.listPengeluaran', compact('cabang_id','total_pendapatan','total_pengeluaran','pendapatan_bersih'));
    }

    public function getAdminCabangSpendings(String $id)
    {

        $spendings = pengeluaran::where('user_id', $id)->get();

        return DataTables::of($spendings)
   
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Get all service data
     */
    public function getTechnicians(String $id)
    {
        $teknisis = teknisi::where('cabang_id', $id)->get();

        return DataTables::of($teknisis)
            // ->addColumn('action', function ($teknisi) {
            //     return '<a href="/teknisi/edit/'.$teknisi->id.'" class="btn btn-sm btn-primary">Edit</a>';
            // })
            ->rawColumns(['action'])
            ->make(true);
    }
}
