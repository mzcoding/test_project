<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Services\Contracts\Rent;
use Carbon\CarbonImmutable;

class ManageRentService implements Rent
{
    public function updateRent(Order $order, int $termRent): OrderStatus
    {
        $rentDate = $order->orderStatus->term_rent_at;
        $nowDate = CarbonImmutable::now();

        if ($nowDate > $rentDate) {
            $rentDate = $nowDate;
        }

        $order->orderStatus->term_rent_at = $rentDate->addHours($termRent);
        $order->orderStatus->save();

        return $order->orderStatus;
    }
}
