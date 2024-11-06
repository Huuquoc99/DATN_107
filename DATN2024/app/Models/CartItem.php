<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_variant_id',
        'quantity',
        'price',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
    
    public function product()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id'); // Đảm bảo bạn thay thế 'product_variant_id' bằng tên cột thực tế trong bảng 'cart_items'
    }
}
