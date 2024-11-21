<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "code",
        "name",
        "description",
        "display_order",
        "is_active",
    ];

    protected $casts = [
        "is_active" => "boolean",
        "display_order" => "integer",
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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
