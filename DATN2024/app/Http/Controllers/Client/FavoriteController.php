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
                'message' => 'You need to login to perform this action.'
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
                'message' => 'The product has been removed from your wishlist.'
            ]);
        } else {
            Favorite::query()->create([
                'user_id' => $user->id,
                'product_id' => $productId
            ]);

            return response()->json([
                'is_favorite' => true,
                'message' => 'The product has been added to your wishlist.'
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
                'message' => 'The selected product id is invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $favorite = Favorite::query()->where('product_id', $request->product_id)->first();

        if ($favorite) {
            $favorite->delete();

            return response()->json([
                'message' => 'Product removed from favorites.',
            ]);
        }

        return response()->json([
            'message' => 'Favorite not found.',
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
