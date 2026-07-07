<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AnalyticsService;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    protected $analyticsService;

    public function __construct(AnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
        $this->middleware(['auth', 'role:admin,super_admin']);
    }

    public function index(Request $request)
    {
        $year = $request->year ?? date('Y');
        $month = $request->month ?? null;
        $period = $request->period ?? 30;

        // Data untuk filter
        $availableYears = range(date('Y'), date('Y') - 5);
        $availableMonths = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        // Data chart pendapatan
        $revenueData = $this->getRevenueData($year, $month, $period);
        
        // Data chart quantity
        $quantityData = $this->getQuantityData($year, $month, $period);

        // Statistik ringkasan
        $summary = [
            'total_revenue' => array_sum($revenueData),
            'total_quantity' => array_sum($quantityData),
            'avg_revenue' => count($revenueData) > 0 ? round(array_sum($revenueData) / count($revenueData), 2) : 0,
            'avg_quantity' => count($quantityData) > 0 ? round(array_sum($quantityData) / count($quantityData), 2) : 0,
            'highest_revenue' => count($revenueData) > 0 ? max($revenueData) : 0,
            'highest_quantity' => count($quantityData) > 0 ? max($quantityData) : 0,
        ];

        return view('admin.charts.index', compact(
            'revenueData', 
            'quantityData', 
            'summary',
            'availableYears', 
            'availableMonths',
            'year',
            'month',
            'period'
        ));
    }

    private function getRevenueData($year, $month, $period)
    {
        $data = [];
        $startDate = now()->subDays($period - 1)->startOfDay();

        for ($i = 0; $i < $period; $i++) {
            $date = $startDate->copy()->addDays($i);
            $revenue = \App\Models\Order::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->sum('grand_total');
            $data[$date->format('d M')] = $revenue;
        }

        return $data;
    }

    private function getQuantityData($year, $month, $period)
    {
        $data = [];
        $startDate = now()->subDays($period - 1)->startOfDay();

        for ($i = 0; $i < $period; $i++) {
            $date = $startDate->copy()->addDays($i);
            $quantity = \App\Models\OrderItem::whereHas('order', function ($query) use ($date) {
                    $query->whereDate('created_at', $date)
                        ->where('status', 'completed');
                })
                ->sum('quantity');
            $data[$date->format('d M')] = $quantity;
        }

        return $data;
    }

    public function data(Request $request)
    {
        $period = $request->period ?? 30;
        
        $revenueData = $this->getRevenueData(null, null, $period);
        $quantityData = $this->getQuantityData(null, null, $period);

        return response()->json([
            'labels' => array_keys($revenueData),
            'revenue' => array_values($revenueData),
            'quantity' => array_values($quantityData),
        ]);
    }
}