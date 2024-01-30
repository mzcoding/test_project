<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderStatus extends Model
{
    use HasFactory;

    public $table = 'statuses';

    protected $with = ['order'];

    protected $fillable = [
        'hash_code',
        'is_rent',
        'term_rent',
        'term_rent_at',
    ];

    protected $casts = [
        'is_rent' => 'boolean',
        'term_rent_at' => 'immutable_datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
