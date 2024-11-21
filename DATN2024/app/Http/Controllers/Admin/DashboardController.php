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
            )
            ->orderByDesc('total_quantity_sold')
            ->get();
    
        $topCustomers = Order::selectRaw('
            orders.user_id,
            users.id,
            users.name,  -- explicitly include name here
            users.email,  -- include other necessary fields
            COUNT(orders.id) AS total_orders,
            SUM(order_items.quantity) AS total_quantity_bought,
            SUM(order_items.product_price_sale * order_items.quantity) AS total_spent
        ')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')  
            ->where('orders.status_order_id', '1')
            ->groupBy('orders.user_id', 'users.id', 'users.name', 'users.email')  
            ->orderByDesc('total_spent') 
            ->get();
        
        $totalEarnings = Order::where('status_order_id', '1')->sum('total_price');
        // dd($totalEarnings);
        $totalOrders = Order::count(); 
        $totalCustomers = User::count();
        $totalProducts = Product::count();
        return view('admin.dashboard.dashboard', compact('statistics', 'topProducts', 'topCustomers', 'totalEarnings', 'totalOrders', 'totalCustomers', 'totalProducts')); 
    }


    public function getSalesData(Request $request)
    {
        $salesData = OrderItem::select('product_name', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(product_price_sale * quantity) as total_sales'))
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->groupBy('product_name')
            ->get();

        return view('admin.dashboard.sales', compact('salesData'));
    }


}
