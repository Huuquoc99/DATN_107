<?php

namespace App\Http\Controllers\Client;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Catalogue;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Models\ProductCapacity;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $productActive = Product::with(['variants', 'galleries'])
            ->active()
            ->get();

        $productHot = Product::with(['variants', 'galleries'])
            ->active()
            ->where('is_hot_deal', 1)
            ->get();

        $productGood = Product::with(['variants', 'galleries'])
            ->active()
            ->where('is_good_deal', 1)
            ->get();

        $productNew = Product::with(['variants', 'galleries'])
            ->active()
            ->where('is_new', 1)
            ->get();

        $productHome = Product::with(['variants', 'galleries'])
            ->active()    
            ->where('is_show_home', 1)
            ->get();


        $catalogues = Catalogue::where('is_active', 1)->get();

        $banners = Banner::where('is_active', 1)->get();

        $catalogues = Catalogue::where('is_active', 1)->get();
        $products = Product::query()->active()->latest('id')->paginate(8);
        return view('client.home', compact('products', 'catalogues'));

    }


    public function productByCatalogue($id)
    {
        $products = Product::query()->active()->where('catalogue_id', $id)->paginate(1);
        return view('client.shop', [
            'products' => $products,
            'source' => 'catalogue',
            'title' => 'Products by category'
        ]);
    }

    // public function shop()
    // {
    //     $products = Product::query()->with(['catalogue'])->latest('id')->paginate(8);
    //     return view('client.shop', [
    //         'products' => $products,
    //         'source' => 'shop',
    //         'title' => 'All products'
    //     ]);
    // }

    public function shop(Request $request)
    {
        $limit = 8;
        $params = $request->only(['c', 'prices', 'color', 'capacity']);
        $products = Product::query()->active()->with(['catalogue']);
        if (isset($params['c'])) {
            $products = $products->where('catalogue_id', $params['c']);
        }
        if (isset($params['color'])) {
            $products = $products->whereHas('variants.color', function ($query) use ($params) {
                $query->where('color_code', $params['color']);
            });
        }
        if (isset($params['prices'])) {
            $selectedPrices = explode(',', $params['prices']);

            $products = $products->where(function ($query) use ($selectedPrices) {
                foreach ($selectedPrices as $priceKey) {
                    switch ($priceKey) {
                        case '1': // Dưới 1 triệu
                            $query->orWhere('price_regular', '<', 1000000);
                            break;

                        case '2': // 1 đến 3 triệu
                            $query->orWhereBetween('price_regular', [1000000, 3000000]);
                            break;

                        case '3': // 3 đến 5 triệu
                            $query->orWhereBetween('price_regular', [3000000, 5000000]);
                            break;

                        case '4': // 5 đến 10 triệu
                            $query->orWhereBetween('price_regular', [5000000, 10000000]);
                            break;

                        case '5': // 10 đến 15 triệu
                            $query->orWhereBetween('price_regular', [10000000, 15000000]);
                            break;

                        case '6': // 15 đến 20 triệu
                            $query->orWhereBetween('price_regular', [15000000, 20000000]);
                            break;

                        case '7': // 20 đến 30 triệu
                            $query->orWhereBetween('price_regular', [20000000, 30000000]);
                            break;

                        case '8': // Trên 30 triệu
                            $query->orWhere('price_regular', '>', 30000000);
                            break;

                        default:
                            break;
                    }
                }
            });
        }
        if (isset($params['capacity'])) {
            $products = $products->whereHas('variants.capacity', function ($query) use ($params) {
                $query->where('name', $params['capacity']);
            });
        }
        $products = $products->latest('id')->paginate($limit);
        $catalogues = Catalogue::query()->active()->get();
        $colors = ProductColor::query()->active()->pluck('color_code');
        $capacities = ProductCapacity::query()->active()->pluck('name');

        return view('client.shop', [
            'products' => $products,
            'catalogues' => $catalogues,
            'capacities' => $capacities,
            'colors' => $colors,
            'source' => 'shop',
            'title' => 'All products'
        ]);
    }
    // public function search(Request $request)
    // {
    //     $keyword = $request->input('keyword');



    public function search(Request $request) {
        $limit = 8;
        $search = $request->get('k');
        $products = Product::query()->active();
        $products->where('name', 'LIKE', '%' . $search . '%')
            ->orWhereHas('catalogue', function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            });
        $products = $products->latest('id')->paginate($limit);
        return view('client.search', [
            'products' => $products
        ]);
    }


    public function about()
    {
        return view('client.about');
    }

    public function contact()
    {
        return view('client.contact');
    }
}