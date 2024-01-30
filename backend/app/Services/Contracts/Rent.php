<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Models\Order;
use App\Models\OrderStatus;

interface Rent
{
   public function updateRent(Order $order, int $termRent): OrderStatus;
}
