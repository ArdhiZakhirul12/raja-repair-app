<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\cabang;
use App\Models\pengeluaran;
use App\Models\sparepartSale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->filled('start_date')
            ? Carbon::parse($request->start_date)->startOfDay()
            : now()->startOfMonth();

        $endDate = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : now()->endOfMonth();

        if ($startDate->gt($endDate)) {
            [$startDate, $endDate] = [$endDate->copy()->startOfDay(), $startDate->copy()->endOfDay()];
        }

        $selectedCabang = $request->query('cabang', 'all');
        $cabangs = collect();

        if (Auth::user()->hasRole('super-admin')) {
            $cabangs = cabang::with('user')->orderBy('nama')->get();
        } else {
            $selectedCabang = Auth::id();
        }

        $bookingBase = booking::with(['customer', 'detailBooking.dataService', 'sparepart_booking.sparepart'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($selectedCabang !== 'all', function ($query) use ($selectedCabang) {
                $query->where('user_id', $selectedCabang);
            });

        $serviceOnlyRows = (clone $bookingBase)
            ->whereHas('detailBooking')
            ->doesntHave('sparepart_booking')
            ->latest()
            ->get()
            ->map(function ($booking) {
                $serviceRevenue = (int) $booking->detailBooking->sum('harga');

                return [
                    'id' => $booking->id,
                    'code' => $booking->kode_pesanan,
                    'customer' => $booking->customer?->nama ?? '-',
                    'date' => $booking->created_at,
                    'service_revenue' => $serviceRevenue,
                    'sparepart_revenue' => 0,
                    'hpp' => 0,
                    'revenue' => $serviceRevenue,
                    'profit' => $serviceRevenue,
                    'items' => $booking->detailBooking
                        ->map(fn ($detail) => $detail->dataService?->nama_servis ?? 'Service')
                        ->filter()
                        ->implode(', '),
                    'url' => route('cs.booking.show', ['id' => $booking->id]),
                ];
            });

        $serviceSparepartRows = (clone $bookingBase)
            ->whereHas('detailBooking')
            ->whereHas('sparepart_booking')
            ->latest()
            ->get()
            ->map(function ($booking) {
                $serviceRevenue = (int) $booking->detailBooking->sum('harga');
                $sparepartRevenue = (int) $booking->sparepart_booking->sum('harga');
                $hpp = (int) $booking->sparepart_booking->sum('harga_beli');
                $revenue = $serviceRevenue + $sparepartRevenue;

                return [
                    'id' => $booking->id,
                    'code' => $booking->kode_pesanan,
                    'customer' => $booking->customer?->nama ?? '-',
                    'date' => $booking->created_at,
                    'service_revenue' => $serviceRevenue,
                    'sparepart_revenue' => $sparepartRevenue,
                    'hpp' => $hpp,
                    'revenue' => $revenue,
                    'profit' => $revenue - $hpp,
                    'items' => $booking->sparepart_booking
                        ->map(fn ($detail) => $detail->sparepart?->nama_sparepart ?? 'Sparepart')
                        ->filter()
                        ->implode(', '),
                    'url' => route('cs.booking.show', ['id' => $booking->id]),
                ];
            });

        $sparepartOnlyRows = sparepartSale::with(['customer', 'detailSale.sparepart'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($selectedCabang !== 'all', function ($query) use ($selectedCabang) {
                $query->where('user_id', $selectedCabang);
            })
            ->latest()
            ->get()
            ->map(function ($sale) {
                $sparepartRevenue = (int) $sale->detailSale->sum('harga');
                $hpp = (int) $sale->detailSale->sum('harga_beli');

                return [
                    'id' => $sale->id,
                    'code' => $sale->kode_pesanan,
                    'customer' => $sale->customer?->nama ?? '-',
                    'date' => $sale->created_at,
                    'service_revenue' => 0,
                    'sparepart_revenue' => $sparepartRevenue,
                    'hpp' => $hpp,
                    'revenue' => $sparepartRevenue,
                    'profit' => $sparepartRevenue - $hpp,
                    'items' => $sale->detailSale
                        ->map(fn ($detail) => $detail->sparepart?->nama_sparepart ?? 'Sparepart')
                        ->filter()
                        ->implode(', '),
                    'url' => route('cs.sale.show', ['id' => $sale->id]),
                ];
            });

        $expenses = (int) pengeluaran::whereBetween('tanggal', [$startDate->toDateString(), $endDate->toDateString()])
            ->when($selectedCabang !== 'all', function ($query) use ($selectedCabang) {
                $query->where('user_id', $selectedCabang);
            })
            ->sum('harga');

        $flows = [
            'service_only' => $this->summarizeFlow('Service', $serviceOnlyRows),
            'service_sparepart' => $this->summarizeFlow('Service + Sparepart', $serviceSparepartRows),
            'sparepart_only' => $this->summarizeFlow('Sparepart Saja', $sparepartOnlyRows),
        ];

        $overall = [
            'transactions' => collect($flows)->sum('transactions'),
            'service_revenue' => collect($flows)->sum('service_revenue'),
            'sparepart_revenue' => collect($flows)->sum('sparepart_revenue'),
            'revenue' => collect($flows)->sum('revenue'),
            'hpp' => collect($flows)->sum('hpp'),
            'gross_profit' => collect($flows)->sum('gross_profit'),
            'expenses' => $expenses,
        ];
        $overall['net_profit'] = $overall['gross_profit'] - $overall['expenses'];

        return view('financial-report.index', compact(
            'startDate',
            'endDate',
            'selectedCabang',
            'cabangs',
            'flows',
            'overall',
            'serviceOnlyRows',
            'serviceSparepartRows',
            'sparepartOnlyRows'
        ));
    }

    private function summarizeFlow(string $label, $rows): array
    {
        return [
            'label' => $label,
            'transactions' => $rows->count(),
            'service_revenue' => $rows->sum('service_revenue'),
            'sparepart_revenue' => $rows->sum('sparepart_revenue'),
            'revenue' => $rows->sum('revenue'),
            'hpp' => $rows->sum('hpp'),
            'gross_profit' => $rows->sum('profit'),
        ];
    }
}
