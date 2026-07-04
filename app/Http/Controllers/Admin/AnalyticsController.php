<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AnalyticsService;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    protected $analyticsService;

    public function __construct(AnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
        $this->middleware(['auth', 'role:admin,super_admin']);
    }

    public function index(Request $request)
    {
        $period = $request->period ?? 30; // days

        $analytics = [
            'daily_visitors' => $this->analyticsService->getDailyVisitors($period),
            'conversion_rate' => $this->analyticsService->getConversionRate($period),
            'average_order_value' => $this->analyticsService->getAverageOrderValue($period),
            'customer_retention' => $this->analyticsService->getCustomerRetentionRate($period),
            
            'sales_trends' => $this->analyticsService->getSalesTrends($period),
            'popular_products' => $this->analyticsService->getPopularProducts(10, $period),
            'category_performance' => $this->analyticsService->getCategoryPerformance($period),
            'customer_demographics' => $this->analyticsService->getCustomerDemographics(),
            
            'pre_order_stats' => $this->analyticsService->getPreOrderStats($period),
            'custom_order_stats' => $this->analyticsService->getCustomOrderStats($period),
            'payment_method_stats' => $this->analyticsService->getPaymentMethodStats($period),
        ];

        return view('admin.analytics.index', compact('analytics', 'period'));
    }
}