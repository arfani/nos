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

        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $ordersPerMonth = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get()
            ->keyBy('month');

        $chartData = [
            'months' => [],
            'totals' => []
        ];

        foreach ($months as $monthNumber => $monthName) {
            $chartData['months'][] = $monthName;
            // Jika data ada untuk bulan tersebut, ambil nilainya. Jika tidak, isi dengan 0.
            $chartData['totals'][] = $ordersPerMonth->get($monthNumber)->total ?? 0;
        }

        return view('admin.index', compact('data', 'chartData'));
    }
}
