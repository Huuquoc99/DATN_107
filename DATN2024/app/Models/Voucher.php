<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'quantity',
        'used_quantity',
        'discount',
        'discount_type',
        'start_date',
        'expiration_date',
        'is_active',
        'min_order_value'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'used_quantity' => 'integer',
        'expiration_date' => 'date',
        'is_active' => 'boolean',
    ];
    // public function scopeActive(Builder $query): void
    // {
    //     $query->where('is_active', true)->where('expiration_date', '>', now());
    // }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true)
            ->where('expiration_date', '>', now())
            ->where('start_date', '<=', now());
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'voucher_product', 'voucher_id', 'product_id');
    }



}
