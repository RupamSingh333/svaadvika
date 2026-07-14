<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Customer;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total Sales (only considering completed/delivered orders, or all? Let's sum total_amount of all non-cancelled orders)
        $totalSales = Order::where('status', '!=', 'cancelled')->sum('total_amount');
        
        // Total Orders
        $totalOrders = Order::count();
        
        // Total Customers
        $totalCustomers = Customer::count();
        
        // Pending Orders
        $pendingOrders = Order::where('status', 'pending')->count();
        
        // Recent Orders
        $recentOrders = Order::with('customer')->latest()->take(5)->get();

        // Revenue Chart Data (Last 7 Days)
        $chartDates = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subDays($i)->format('Y-m-d');
            $chartDates[] = \Carbon\Carbon::parse($date)->format('M d');
            $chartData[] = Order::whereDate('created_at', $date)->where('status', '!=', 'cancelled')->sum('total_amount');
        }

        return view('admin.dashboard.index', compact(
            'totalSales',
            'totalOrders',
            'totalCustomers',
            'pendingOrders',
            'recentOrders',
            'chartDates',
            'chartData'
        ));
    }
}
