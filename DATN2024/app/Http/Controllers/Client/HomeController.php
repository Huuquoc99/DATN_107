<?php

namespace App\Http\Controllers\Client;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $productActive = Product::with(['variants', 'galleries'])
            ->where('is_active', 1)
            ->get();

        $productHot = Product::with(['variants', 'galleries'])
            ->where('is_hot_deal', 1)
            ->get();

        $productGood = Product::with(['variants', 'galleries'])
            ->where('is_good_deal', 1)
            ->get();

        $productNew = Product::with(['variants', 'galleries'])
            ->where('is_new', 1)
            ->get();

        $productHome = Product::with(['variants', 'galleries'])
            ->where('is_show_home', 1)
            ->get();


        $catalogues = Catalogue::where('is_active', 1)->get();

        $banners = Banner::where('is_active', 1)->get();

        $catalogues = Catalogue::where('is_active', 1)->get();
        $products = Product::query()->latest('id')->paginate(8);
        return view('client.home', compact('products', 'catalogues'));

    }


    public function productByCatalogue($id)
    {
        $products = Product::query()->where('catalogue_id', $id)->paginate(1);
        return view('client.shop', [
            'products' => $products,
            'source' => 'catalogue',
            'title' => 'Products by category'
        ]);
    }

    public function shop()
    {
        $products = Product::query()->with(['catalogue'])->latest('id')->paginate(8);
        return view('client.shop', [
            'products' => $products,
            'source' => 'shop',
            'title' => 'All products'
        ]);
    }

    public function search(Request $request) {



//    return view('shop', [
//        'products' => $products,
//        'source' => 'search',
//        'title' => 'Kết quả tìm kiếm',
//        'keyword' => $request->keyword
//    ]);
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

