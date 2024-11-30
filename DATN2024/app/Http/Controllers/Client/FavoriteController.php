<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
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


    public function listFavorites()
    {
        $favorites = Auth::user()
            ->favorites()
            ->with('product')
            ->latest()
            ->paginate(10);

        return view('client.favorites', compact('favorites'));
    }
}
