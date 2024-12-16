<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Builder;

class Catalogue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "cover",
        "is_active",
    ];

    protected $casts = [
        "is_active" => "boolean",
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }
    
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', 1);
    }
}
