<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property OrderStatus $orderStatus
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderStatus(): HasOne
    {
        return $this->hasOne(OrderStatus::class, 'order_id');
    }
}
