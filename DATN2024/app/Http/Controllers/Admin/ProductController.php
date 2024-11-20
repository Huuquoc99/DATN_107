<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Catalogue;
use App\Models\Product;
use App\Models\ProductCapacity;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductVariant;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.products.';

    public function index()
    {
        $data = Product::query()->with(['catalogue'])->latest('id')->paginate(5);
        $catalogues = Catalogue::all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'catalogues'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catalogues = Catalogue::query()
            ->where('is_active', 1)
            ->pluck('name', 'id')
            ->all();
            
        $colors = ProductColor::query()
            ->where('is_active', 1)
            ->pluck('name', 'id')
            ->all();

        $capacity = ProductCapacity::query()
            ->where('is_active', 1)
            ->pluck('name', 'id')
            ->all();

        $tags = Tag::query()->pluck('name', 'id')->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('catalogues', 'colors', 'capacity', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        list(
            $dataProduct,
            $dataProductVariants,
            $dataNewProductVariants,
            $dataProductGalleries,
            $dataProductTags
            ) = $this->handleData($request);

        try {
            DB::beginTransaction();

            /** @var Product $product */
            $product = Product::query()->create($dataProduct);

            foreach ($dataProductVariants as $item) {
                $item += ['product_id' => $product->id];

                ProductVariant::query()->create($item);
            }

            foreach ($dataNewProductVariants as $item) {
                if (!empty($item_update['size']) && !empty($item_update['color'])) {
                    $size = ProductCapacity::query()->firstOrCreate(
                        ['name' => $item['size']],
                        ['is_active' => 1]
                    );

                    $color = ProductColor::query()->firstOrCreate(
                        ['name' => $item['color']],
                        ['is_active' => 1]
                    );

                    $item += [
                        'product_id' => $product->id,
                        'product_capacity_id' => $size->id,
                        'product_color_id' => $color->id,
                    ];

                    ProductVariant::query()->create($item);
                }
            }


            foreach ($dataProductGalleries as $item) {
                $item += ['product_id' => $product->id];

                ProductGallery::query()->create($item);
            }

            $product->tags()->attach($dataProductTags);

            DB::commit();
            return redirect()->route('admin.products.index')->with("success", "Product created successfully");
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['variants', 'galleries', 'tags']);

        $totalQuantity = $product->variants->sum('quantity');

        $color = ProductColor::query()->pluck('name', 'id')->all();
        $capacity = ProductCapacity::query()->pluck('name', 'id')->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'capacity','color','totalQuantity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $catalogues = Catalogue::query()->pluck('name', 'id')->all();


        $colors = ProductColor::query()
            ->where('is_active', 1)
            ->pluck('name', 'id')
            ->all();

        $capacities = ProductCapacity::query()
            ->where('is_active', 1)
            ->pluck('name', 'id')
            ->all();
        $tags = Tag::query()->pluck('name', 'id')->all();

        $product->load(['catalogue', 'tags', 'variants', 'galleries']);

        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'catalogues', 'colors', 'capacities', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {

        list(
            $dataProduct,
            $dataProductVariants,
            $dataNewProductVariants,
            $dataProductGalleries,
            $dataProductTags
            ) = $this->handleData($request);

        try {
            DB::beginTransaction();

            $productImgThumbnailCurrent = $product->img_thumbnail;

            $product->update($dataProduct);


            foreach ($dataProductVariants as  $item) {
                $existingVariant = ProductVariant::query()->where([
                    'product_id' => $product->id,
                    'product_capacity_id' => $item['product_capacity_id'],
                    'product_color_id' => $item['product_color_id'],
                ])->first();

                if ($existingVariant) {
                    if (empty($item['image'])) {
                        $item['image'] = $existingVariant->image;
                    }
                    $existingVariant->update($item);
                }
            }

            foreach ($dataNewProductVariants as $item_update) {
                if (!empty($item_update['size']) && !empty($item_update['color'])) {
                    $size = ProductCapacity::query()->firstOrCreate(
                        ['name' => $item_update['size']],
                        ['is_active' => 1]
                    );

                    $color = ProductColor::query()->firstOrCreate(
                        ['name' => $item_update['color']],
                        ['is_active' => 1]
                    );

                    $item_update += [
                        'product_id' => $product->id,
                        'product_capacity_id' => $size->id,
                        'product_color_id' => $color->id,
                    ];

                    ProductVariant::query()->create($item_update);
                }
            }



            if ($request->has('delete_galleries')) {
                foreach ($request->delete_galleries as $galleryId) {
                    $gallery = ProductGallery::find($galleryId);
                    if ($gallery) {
                        Storage::delete($gallery->image);
                        $gallery->delete();
                    }
                }
            }

            if ($request->hasFile('product_galleries')) {
                foreach ($request->file('product_galleries') as $image) {
                    $path = $image->store('product_galleries', 'public');

                    ProductGallery::query()->create([
                        'product_id' => $product->id,
                        'image' => $path
                    ]);
                }
            }

            $product->tags()->sync($dataProductTags);

            DB::commit();

            if (!empty($dataProduct['img_thumbnail']) && $dataProduct['img_thumbnail'] !== $productImgThumbnailCurrent) {
                if (!empty($productImgThumbnailCurrent) && Storage::exists($productImgThumbnailCurrent)) {
                    Storage::delete($productImgThumbnailCurrent);
                }
            }
            return redirect()->route('admin.products.index')->with("success", "Product updated successfully");
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            DB::rollBack();

            foreach ($dataProductGalleries as $item) {
                if (!empty($item['image']) && Storage::exists($item['image'])) {
                    Storage::delete($item['image']);
                }
            }

            foreach ($dataProductVariants as $item) {
                if (!empty($item['image']) && Storage::exists($item['image'])) {
                    Storage::delete($item['image']);
                }
            }

            return back()->with('error', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        try {
            $check_cartItem = $product->variants()->whereHas('cartItems')->exists();

            if ($check_cartItem) {
                return back()->with('error', 'Sản phẩm này đang có trong giỏ hàng của người dùng và không thể xóa.');
            }

            $dataHasImage = $product->galleries->toArray() + $product->variants->toArray();

            DB::transaction(function () use ($product) {
                $product->tags()->sync([]);
                $product->galleries()->delete();

                foreach ($product->variants as $variant) {
                    $variant->orderItems()->delete();
                }
                $product->variants()->delete();
                $product->delete();
            }, 3);

            foreach ($dataHasImage as $item) {
                if (!empty($item->image) && Storage::exists($item->image)) {
                    Storage::delete($item->image);
                }
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Product deleted successfully!');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }


    private function handleData(Request $request)
    {
        $dataProduct = $request->except(['tags','product_galleries','new_product_variants']);
        $dataProduct['is_active'] ??= 0;
        $dataProduct['is_hot_deal'] ??= 0;
        $dataProduct['is_good_deal'] ??= 0;
        $dataProduct['is_new'] ??= 0;
        $dataProduct['is_show_home'] ??= 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];

        $dataProduct['description'] = $request->input('description');

        if (!empty($dataProduct['img_thumbnail'])) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
        }

        $dataNewProductVariantsTmp = $request->new_product_variants;

        $dataNewProductVariants = [];

        if (is_array($dataNewProductVariantsTmp) && !empty($dataNewProductVariantsTmp)) {
            foreach ($dataNewProductVariantsTmp as $key => $item) {
                $dataNewProductVariants[] = [
                    'size' => $item['size'] ?? null,
                    'color' => $item['color'] ?? null,
                    'quantity' => $item['quantity'] ?? 0,
                    'price' => $item['price'] ?? 0,
                    'sku' => $item['sku'] ?? null,
                    'status' => isset($item['status']) && $item['status'] == 1 ? 0 : 1,
                    'image' => !empty($item['image']) ? Storage::put('product_variants', $item['image']) : null,
                ];
            }
        }



        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];
        foreach ($dataProductVariantsTmp as $key => $item) {
            $tmp = explode('-', $key);
            $dataProductVariants[] = [
                'product_capacity_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'status' => isset($item['status']) && $item['status'] == 1 ? 0 : 1,
                'image' => !empty($item['image']) ? Storage::put('product_variants', $item['image']) : null
            ];
        }

        $dataProductGalleriesTmp = $request->product_galleries ?: [];
        $dataProductGalleries = [];
        foreach ($dataProductGalleriesTmp as $image) {
            if (!empty($image)) {
                $dataProductGalleries[] = [
                    'image' => Storage::put('product_galleries', $image)
                ];
            }
        }

        $dataProductTags = $request->tags;

        return [$dataProduct,$dataProductVariants, $dataNewProductVariants, $dataProductGalleries, $dataProductTags];
    }



    public function filter(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search_string')) {
            $searchString = $request->search_string;
            $query->where(function ($q) use ($searchString) {
                $q->where('name', 'like', '%' . $searchString . '%')
                    ->orWhere('price_regular', 'like', '%' . $searchString . '%')
                    ->orWhere('battery_capacity', 'like', '%' . $searchString . '%')
                    ->orWhere('camera_resolution', 'like', '%' . $searchString . '%')
                    ->orWhere('operating_system', 'like', '%' . $searchString . '%')
                    ->orWhere('processor', 'like', '%' . $searchString . '%')
                    ->orWhere('ram', 'like', '%' . $searchString . '%')
                    ->orWhere('storage', 'like', '%' . $searchString . '%')
                    ->orWhere('sim_type', 'like', '%' . $searchString . '%')
                    ->orWhere('network_connectivity', 'like', '%' . $searchString . '%');
            });
        }


        if ($request->filled('category_id')) {
            $query->where('catalogue_id', $request->category_id);
        }

        if ($request->filled('filter')) {
            switch ($request->filter) {
                case 'is_active':
                    $query->where('status', 'is_active');
                    break;
                case 'is_new':
                    $query->where('status', 'is_new');
                    break;
                case 'outOfStock':
                    $query->where('quantity', 0);
                    break;
                case 'priceAsc':
                    $query->orderBy('price_regular', 'asc');
                    break;
                case 'priceDesc':
                    $query->orderBy('price_regular', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'yesterday':
                    $query->whereDate('created_at', Carbon::yesterday());
                    break;
                case 'lastWeek':
                    $query->whereBetween('created_at', [
                        Carbon::now()->subWeek(),
                        Carbon::now()
                    ]);
                    break;
                case 'lastMonth':
                    $query->whereBetween('created_at', [
                        Carbon::now()->subMonth(),
                        Carbon::now()
                    ]);
                    break;
                case 'lowStock':
                    $query->where('quantity', '<=', 10)
                        ->where('quantity', '>', 0);
                    break;
                case 'inStock':
                    $query->where('quantity', '>', 0);
                    break;
            }
        }

        $data = $query->paginate(12);

        return view('admin.products.filter', compact('data'))->render();
    }
}
