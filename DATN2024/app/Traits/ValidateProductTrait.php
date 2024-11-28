<?php

namespace App\Traits;

use App\Models\Order;

trait ValidateProductTrait
{
    public function saveSessionUI()
    {
        if ($this->product_variants) {
            $product_variants = [];
            foreach ($this->product_variants as $key => $product_variant) {
                $product_variants[$key] = [
                    'quantity' => $product_variant['quantity'],
                    'price' => $product_variant['price'],
                    'image' => @$product_variant['image'] ? $product_variant['image']->getClientOriginalName() : null,
                ];
            }

            session()->put('product_variants', $product_variants);
        }

        if ($this->new_product_variants) {
            $new_product_variants = [];
            foreach ($this->new_product_variants as $key => $new_product_variant) {
                $new_product_variants[$key] = [
                    'size' => $new_product_variant['size'],
                    'color' => $new_product_variant['color'],
                    'quantity' => $new_product_variant['quantity'],
                    'price' => $new_product_variant['price'],
                    'image' => @$new_product_variant['image'] ? $new_product_variant['image']->getClientOriginalName() : null,
                ];
            }
            session()->put('new_product_variants', $new_product_variants);
        }

        if ($this->product_galleries) {
            $product_gallery_file_name = [];
            foreach ($this->product_galleries as $key => $product_gallery) {
                $file_name  = $product_gallery->getClientOriginalName();
                $product_gallery_file_name[] = $file_name;
            }
            session()->put('product_galleries', $product_gallery_file_name);
        }
    }
}
