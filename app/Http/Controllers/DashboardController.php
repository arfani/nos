<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function __invoke()
    {
        $data = [
            'products' => Product::count(),
            'members' => User::whereNot('level_id', 1)->count(),
            'orders_this_year' => Order::whereYear('created_at', now()->year)->count(),
            'orders_today' => Order::whereDate('created_at', now())->count(),
            'order_products_this_year' => OrderDetail::whereYear('created_at', now()->year)->count(),
            'order_products_today' => OrderDetail::whereDate('created_at', now())->count(),
        ];


        $ordersPerMonth = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get();

            $chartData = [
                'months' => [],
                'totals' => []
            ];
            
            foreach ($ordersPerMonth as $order) {
                $chartData['months'][] = \Carbon\Carbon::create()->month($order->month)->format('F'); // Nama bulan (misalnya: January, February)
                $chartData['totals'][] = $order->total;
            }

        return view('admin.index', compact('data', 'chartData'));
    }
}
