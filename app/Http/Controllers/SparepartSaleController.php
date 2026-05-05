<?php

namespace App\Http\Controllers;

use App\Models\sparepartSale;
use App\Models\detailSale;
use Illuminate\Http\Request;

class SparepartSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = sparepartSale::with(['customer','detailSale'])->get();
        // dd($sales);
        return view('customer-service.sparepart-sale.index', compact('sales'));
    }
    public function getSale(Request $request)
    {
        $query = sparepartSale::where('user_id', auth()->id());

        // Tambahkan filter berdasarkan status jika ada
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('created_at', 'desc')->get();

        return DataTables::of($bookings)
            ->rawColumns(['action'])
            ->make(true);
        
    }

    public function printSale($id)
    {
        $sale = sparepartSale::with([
        'detailSale'
    ])->findOrFail($id);
        $total = $sale->detailSale->sum('harga');   

    return view('customer-service.print.print-sale', compact('sale','total'));
    }
//     public function getSale(Request $request)
// {
//     $query = SparepartSale::with(['customer', 'detailSale'])
//         ->where('user_id', auth()->id());
//     return DataTables::of($query)->make(true);
// }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer-service.sparepart-sale.create');
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
