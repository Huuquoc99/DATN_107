<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
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
        $data = Product::query()->with(['catalogue', 'tags'])->latest('id')->paginate(5);
        $catalogues = Catalogue::all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'catalogues'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catalogues = Catalogue::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()
            ->where('status', 1)
            ->pluck('name', 'id')
            ->all();

        $capacity = ProductCapacity::query()
            ->where('status', 1)
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

            $product->tags()->attach($dataProductTags);


            foreach ($dataProductGalleries as $item) {
                $item += ['product_id' => $product->id];

                ProductGallery::query()->create($item);
            }

            DB::commit();
            return redirect()->route('admin.products.index');
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

        $color = ProductColor::query()->pluck('name', 'id')->all();
        $capacity = ProductCapacity::query()->pluck('name', 'id')->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'capacity','color'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $catalogues = Catalogue::query()->pluck('name', 'id')->all();
        $colors =  ProductColor::query()->pluck('name', 'id')->all();
        $capacities = ProductCapacity::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();

        $product->load(['catalogue', 'tags', 'variants', 'galleries']);

        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'catalogues', 'colors', 'capacities', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        list(
            $dataProduct,
            $dataProductVariants,
            $dataProductGalleries,
            $dataProductTags
            ) = $this->handleData($request);

        try {
            DB::beginTransaction();

            $productImgThumbnailCurrent = $product->img_thumbnail;

            $product->update($dataProduct);

            $product->tags()->sync($dataProductTags);

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


            foreach ($dataProductGalleries as $item) {
                $item['product_id'] = $product->id;

                // Kiểm tra nếu có 'id' trong $item thì sẽ cập nhật, nếu không sẽ tạo mới
                ProductGallery::query()->updateOrCreate(
                    isset($item['id']) ? ['id' => $item['id']] : [],
                    $item
                );
            }

            DB::commit();

            if (!empty($dataProduct['img_thumbnail']) && $dataProduct['img_thumbnail'] !== $productImgThumbnailCurrent) {
                if (!empty($productImgThumbnailCurrent) && Storage::exists($productImgThumbnailCurrent)) {
                    Storage::delete($productImgThumbnailCurrent);
                }
            }
            return redirect()->route('admin.products.index');
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
                ->with('success', 'User deleted successfully!');;
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    private function handleData(Request $request)
    {
        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);
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

        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];
        foreach ($dataProductVariantsTmp as $key => $item) {
            $tmp = explode('-', $key);
            $dataProductVariants[] = [
                'product_capacity_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'sku' => $item['sku'],
                'status' => isset($item['status']) && $item['status'] == 1 ? 1 : 0,
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

        return [$dataProduct,$dataProductVariants, $dataProductGalleries, $dataProductTags];
    }


    public function pagination()
    {
        $data = Product::query()->with(['catalogue', 'tags'])->latest('id')->paginate(5);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'))->render();
    }

    public function search(Request $request)
    {
        $data = Product::query()->where('name', 'like', '%'.$request->search_string.'%')
            ->orWhere('price_regular', 'like', '%'.$request->search_string.'%')
            ->orderBy('id', 'desc')
            ->paginate(5);

        if($data->count() >= 1) {
            return view('admin.products.pagination', compact('data'))->render();
        } else {
            return response()->json([
                'status' => 'Không tìm thất kết quả!',
            ],404);
        }
    }

    public function filter(Request $request)
    {
        $query = Product::query();

        // Xử lý lọc theo danh mục nếu có
        if ($request->filled('category_id')) {
            $query->where('catalogue_id', $request->category_id);
        }

        if ($request->filled('filter')) {
            switch($request->filter) {
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

        $data = $query->get();

        // Trả về view partial chỉ chứa phần table body
        return view('admin.products.filter', compact('data'))->render();
    }

}
