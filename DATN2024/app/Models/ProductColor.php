<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class ProductColor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "color_code",
        "is_active",
    ];

    protected $casts = [
        "is_active" => "boolean",
    ];

    public function hide()
    {
        $this->is_active = 0;
        $this->save();
    }

    public function show()
    {
        $this->is_active = 1;
        $this->save();
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', 1);
    }
}
