<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function statistics(Request $request)
    {
        $start_date = $request->start_date ? Carbon::parse($request->start_date)->startOfDay() : Carbon::now()->startOfYear();
        $end_date = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : Carbon::now()->endOfDay();


        $statistics = OrderItem::selectRaw('
            GROUP_CONCAT(DISTINCT products.name) AS product_name,
            order_items.product_name AS order_product_name,
            order_items.product_price_sale AS sale_price,
            SUM(order_items.quantity) AS total_quantity_sold,
            SUM(order_items.quantity * order_items.product_price_sale) AS total_revenue,
            DATE_FORMAT(orders.created_at, "%Y-%m") AS month_year
        ')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_variant_id')
            ->where('orders.status_order_id', '1')
            ->whereBetween('orders.created_at', [$start_date, $end_date])
            ->groupBy('order_items.product_variant_id', 'order_items.product_name', 'order_items.product_price_sale', 'month_year', 'products.name')
            ->orderByDesc('total_revenue')
            ->get();

        $topProducts = Product::select(
            'products.*',
            DB::raw('COALESCE(SUM(order_items.quantity), 0) as total_quantity_sold'),
            DB::raw('COALESCE(SUM(order_items.product_price_sale * order_items.quantity), 0) as total_sales')
        )
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_variant_id')
            ->leftJoin('orders', 'orders.id', '=', 'order_items.order_id')
            ->where(function($query) {
                $query->where('orders.status_order_id', '1')
                    ->orWhereNull('orders.status_order_id');
            })
            ->whereNull('orders.deleted_at')
            ->groupBy(
                'products.id',
                'products.catalogue_id',
                'products.name',
                'products.slug',
                'products.sku',
                'products.created_at',
                'products.img_thumbnail',
                'products.price_regular',
                'products.price_sale',
                'products.short_description',
                'products.description',
                'products.screen_size',
                'products.battery_capacity',
                'products.camera_resolution',
                'products.operating_system',
                'products.processor',
                'products.ram',
                'products.storage',
                'products.sim_type',
                'products.network_connectivity',
                'products.is_active',
                'products.is_hot_deal',
                'products.is_good_deal',
                'products.is_new',
                'products.is_show_home',
                'products.updated_at',
                'products.created_at',
                'products.deleted_at',
                'products.views'
            )
            ->orderByDesc('total_quantity_sold')
            ->get();

        $topCustomers = Order::selectRaw('
            orders.user_id,
            users.id,
            users.name,  -- explicitly include name here
            users.email,  -- include other necessary fields
            users.avatar,
            COUNT(orders.id) AS total_orders,
            SUM(order_items.quantity) AS total_quantity_bought,
            SUM(order_items.product_price_sale * order_items.quantity) AS total_spent
        ')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('orders.status_order_id', '1')
            ->groupBy('orders.user_id', 'users.id', 'users.name', 'users.email', 'users.avatar')
            ->orderByDesc('total_spent')
            ->get();

        // $totalEarnings = Order::where('status_order_id', '1')->sum('total_price');
        $totalEarnings = Order::where('status_order_id', 5)
            ->where('status_payment_id', 2)
            ->sum('total_price');

        $totalOrders = Order::count();
        $totalCustomers = User::count();
        $totalProducts = Product::count();

        $topOrders = Order::with('orderItems.product')
            ->get()
            ->sortByDesc(function ($order) {
                return $order->orderItems->sum(function ($item) {
                    return $item->product_price_sale * $item->quantity;
                });
            })
            ->take(4);
        return view('admin.dashboard.dashboard', compact('statistics', 'topProducts', 'topCustomers', 'totalEarnings', 'totalOrders', 'totalCustomers', 'totalProducts', 'topOrders'));
    }



    public function getEarnings(Request $request)
    {
        $period = $request->query('period');

        switch ($period) {
            case '1m':
                $startDate = now()->subMonth();
                break;
            case '6m':
                $startDate = now()->subMonths(6);
                break;
            case '1y':
                $startDate = now()->subYear();
                break;
            default:
                $startDate = null; // ALL
                break;
        }

        $query = Order::where('status_order_id', 5);

        if ($startDate) {
            $query->where('created_at', '>=', $startDate);
        }

        $totalEarnings = $query->sum('total_price');

        return response()->json([
            'total_earnings' => $totalEarnings,
        ]);
    }



    public function getSalesData(Request $request)
    {
        $salesData = OrderItem::select('product_name', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(product_price_sale * quantity) as total_sales'))
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->groupBy('product_name')
            ->get();

        return view('admin.dashboard.sales', compact('salesData'));
    }

    public function getSalesDataProvice()
    {
        $salesData = DB::table('orders')
            ->select('shipping_province', DB::raw('SUM(total_price) as total_sales'))
            ->where('status_order_id', 5)
            ->where('status_payment_id', 2)
            ->groupBy('shipping_province')
            ->orderByDesc('total_sales')
            ->get();

        return response()->json($salesData);

    }

}
