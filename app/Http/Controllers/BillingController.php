<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\booking;
use App\Models\cabang;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    public function index(Request $request)
    {
        $percentage = (float) AppSetting::getValue('service_billing_percentage', 1);
        $selectedMonth = $request->query('month', now()->format('Y-m'));
        $selectedCabang = $request->query('cabang', 'all');
        $startDate = Carbon::createFromFormat('Y-m', $selectedMonth)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();
        $cabangs = Auth::user()->hasRole('super-admin') ? cabang::with('user')->orderBy('nama')->get() : collect();

        if (! Auth::user()->hasRole('super-admin')) {
            $selectedCabang = Auth::id();
        }

        $bookingQuery = booking::with(['user.cabang', 'customer', 'detailBooking.dataService'])
            ->withSum('detailBooking as total_service', 'harga')
            ->whereHas('detailBooking')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($selectedCabang !== 'all', function (Builder $query) use ($selectedCabang) {
                $query->where('user_id', $selectedCabang);
            })
            ->orderByDesc('created_at');

        $transactions = $bookingQuery->get()->map(function ($booking) use ($percentage) {
            $booking->billing_amount = round(((int) $booking->total_service) * $percentage / 100);
            return $booking;
        });

        $totalService = $transactions->sum('total_service');
        $totalBilling = $transactions->sum('billing_amount');

        $monthlyTotals = booking::query()
            ->join('detail_bookings', 'bookings.id', '=', 'detail_bookings.booking_id')
            ->selectRaw("DATE_FORMAT(bookings.created_at, '%Y-%m') as month")
            ->selectRaw('SUM(detail_bookings.harga) as total_service')
            ->whereYear('bookings.created_at', Carbon::parse($selectedMonth . '-01')->year)
            ->when($selectedCabang !== 'all', function ($query) use ($selectedCabang) {
                $query->where('bookings.user_id', $selectedCabang);
            })
            ->groupBy(DB::raw("DATE_FORMAT(bookings.created_at, '%Y-%m')"))
            ->orderBy('month')
            ->get()
            ->map(function ($item) use ($percentage) {
                $item->billing_amount = round(((int) $item->total_service) * $percentage / 100);
                $item->label = Carbon::createFromFormat('Y-m', $item->month)->translatedFormat('F Y');
                return $item;
            });

        $branchTotals = collect();
        if (Auth::user()->hasRole('super-admin')) {
            $branchTotals = booking::query()
                ->join('detail_bookings', 'bookings.id', '=', 'detail_bookings.booking_id')
                ->leftJoin('cabangs', 'bookings.user_id', '=', 'cabangs.user_id')
                ->selectRaw("COALESCE(cabangs.nama, 'Tanpa Cabang') as cabang_nama")
                ->selectRaw('bookings.user_id')
                ->selectRaw('SUM(detail_bookings.harga) as total_service')
                ->whereBetween('bookings.created_at', [$startDate, $endDate])
                ->when($selectedCabang !== 'all', function ($query) use ($selectedCabang) {
                    $query->where('bookings.user_id', $selectedCabang);
                })
                ->groupBy('bookings.user_id', 'cabangs.nama')
                ->orderBy('cabang_nama')
                ->get()
                ->map(function ($item) use ($percentage) {
                    $item->billing_amount = round(((int) $item->total_service) * $percentage / 100);
                    return $item;
                });
        }

        return view('billing.index', compact(
            'percentage',
            'selectedMonth',
            'selectedCabang',
            'cabangs',
            'transactions',
            'totalService',
            'totalBilling',
            'monthlyTotals',
            'branchTotals'
        ));
    }

    public function updatePercentage(Request $request)
    {
        abort_unless(Auth::user()->hasRole('super-admin'), 403);

        $validated = $request->validate([
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        AppSetting::setValue('service_billing_percentage', (string) $validated['percentage']);

        return back()->with('success', 'Persentase tagihan berhasil diperbarui.');
    }
}
