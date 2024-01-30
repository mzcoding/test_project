<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Collection;

interface OrderCode
{
    public function generateCode(Order $order): string;
    public function getOrderByCode(string $hashCode): ?OrderStatus;
}
