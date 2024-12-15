<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UserFavorites
{
    public function getUserFavorites()
    {
        if (Auth::check()) {
            $favorites = Auth::user()
                ->favorites()
                ->with('product')
                ->latest()
                ->paginate(10);

            $favoriteProductIds = $favorites->pluck('product_id')->toArray();
        } else {
            $favoriteProductIds = [];
        }

        return [
            'favorites' => $favorites ?? collect(),
            'favoriteProductIds' => $favoriteProductIds,
        ];
    }
}
