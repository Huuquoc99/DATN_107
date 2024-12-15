<?php

namespace App\Traits;

use App\Models\OrderStatusLog;
use Illuminate\Support\Facades\Auth;

trait OrderStatusTrait
{
    protected static function bootOrderStatusTrait()
    {
        static::updated(function ($model) {
            if ($model->isDirty('status_order_id')) {
                $model->logStatusChange();
            }
        });
    }

    public function logStatusChange()
    {

        $this->statusChanges()->create([
            'old_status' => $this->getOriginal('status_order_id'),
            'new_status' => $this->status_order_id,
            'changed_by' => Auth::id() ?? null,
            'changed_at' => now()
        ]);
    }

    public function statusChanges()
    {
        return $this->morphMany(OrderStatusLog::class, 'loggable');
    }
}
