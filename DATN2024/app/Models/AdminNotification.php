<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'data',
        'read_at',
    ];
    protected $casts = [
        'data' => 'json'
    ];

    public function scopeUnread(Builder $query): void
    {
        $query->whereNull('read_at');
    }
}
