<?php

namespace App\Http\Controllers;

use App\Models\sparepartSale;
use App\Models\detailSale;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SparepartSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = sparepartSale::with(['customer','detailSale.sparepart','metodePembayaran'])->get();
        // dd($sales);
        return view('customer-service.sparepart-sale.index', compact('sales'));
    }
    public function getSale(Request $request)
    {
        $query = sparepartSale::with(['customer','detailSale.sparepart','metodePembayaran'])
            ->where('user_id', auth()->id());

        // Tambahkan filter berdasarkan status jika ada
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $sales = $query->orderBy('created_at', 'desc')->get();

        return DataTables::of($sales)
            ->addColumn('customer_name', function ($sale) {
                return $sale->customer?->nama ?? '-';
            })
            ->addColumn('customer_phone', function ($sale) {
                return $sale->customer?->no_hp ?? '-';
            })
            ->addColumn('payment_method', function ($sale) {
                return $sale->metodePembayaran?->metode ?? '-';
            })
            ->addColumn('item_count', function ($sale) {
                return $sale->detailSale->count();
            })
            ->addColumn('items_summary', function ($sale) {
                return $sale->detailSale
                    ->map(fn ($detail) => $detail->sparepart?->nama_sparepart ?? 'Sparepart')
                    ->take(3)
                    ->implode(', ') ?: '-';
            })
            ->rawColumns(['action'])
            ->make(true);
        
    }

    public function printSale($id)
    {
        $sale = sparepartSale::with([
        'detailSale.sparepart',
        'customer',
        'metodePembayaran'
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
        $sale = sparepartSale::with(['customer', 'detailSale.sparepart', 'metodePembayaran'])
            ->when(!auth()->user()->hasRole('super-admin'), function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->findOrFail($id);

        $total = $sale->detailSale->sum('harga');

        return view('customer-service.sparepart-sale.detail', compact('sale', 'total'));
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
