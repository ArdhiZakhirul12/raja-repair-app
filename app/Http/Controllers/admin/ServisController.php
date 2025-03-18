<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\cabang;
use App\Models\dataService;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class ServisController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        
        return view('admin.servis.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cabangs = cabang::all();
        return view('admin.servis.add-service', compact('cabangs'));
    }
    public function getServices()
    {
        $services = dataService::all()->unique('code');
    
        return DataTables::of($services)
            ->addColumn('action', function ($service) {
                return '<a href="/service/edit/'.$service->id.'" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $auth = Auth::user();
        $validated = $request->validate([
            'nama_servis' => 'required|string|min:3',
            'code' => [
                'required',
                'string',
                'min:3',
                Rule::unique('data_services', 'code')->where('user_id', 'data_services.user_id'),
            ],
            'jenis_servis' => 'required',
            'status' => '1',
            'harga' => 'required|integer',
            'garansi_1' => 'nullable|integer',
            'garansi_2' => 'nullable|integer',
            'garansi_3' => 'nullable|integer',
        ]);
        $cabangs = User::role('cabang')->pluck('id');
        // dd($request->all(), $cabang);

        foreach ($cabangs as $cabang) {
            $validated['user_id'] = $cabang;
            dataService::create($validated);
        }
        return redirect()->back()->with('success', 'Data service berhasil ditambahkan!');
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
