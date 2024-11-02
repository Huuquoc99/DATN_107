<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "image",
        "name",
        "description",
        "display_order",
        "is_active",
    ];

    protected $casts = [
        "is_active" => "boolean",
        "display_order" => "integer",
    ];
}
