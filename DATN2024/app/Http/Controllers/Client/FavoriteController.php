<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use App\Traits\UserFavorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    use UserFavorites;

    public function toggleFavorite(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Bạn cần phải đăng nhập để thực hiện hành động này.'
            ], 401);
        }

        $user = Auth::user();
        $productId = $request->input('product_id');

        $favorite = Favorite::query()->where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($favorite) {
            $favorite->delete();

            return response()->json([
                'is_favorite' => false,
                'message' => 'Sản phẩm đã bị xóa khỏi danh sách mong muốn của bạn.'
            ]);
        } else {
            Favorite::query()->create([
                'user_id' => $user->id,
                'product_id' => $productId
            ]);

            return response()->json([
                'is_favorite' => true,
                'message' => 'Sản phẩm đã được thêm vào danh sách mong muốn của bạn.'
            ]);
        }
    }

    public function removeFavorite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Mã sản phẩm đã chọn không hợp lệ.',
                'errors' => $validator->errors()
            ], 422);
        }

        $favorite = Favorite::query()->where('product_id', $request->product_id)->first();

        if ($favorite) {
            $favorite->delete();

            return response()->json([
                'message' => 'Sản phẩm đã bị xóa khỏi mục yêu thích.',
            ]);
        }

        return response()->json([
            'message' => 'Không tìm thấy mục yêu thích.',
        ], 404);
    }



    public function listFavorites()
    {
        $favorites = Auth::user()
            ->favorites()
            ->with('product')
            ->latest()
            ->paginate(10);

        $favoriteProductIds = $this->getUserFavorites()['favoriteProductIds'];

        return view('client.account.list-favorites', compact('favorites','favoriteProductIds'));
    }
}
