<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Services\Contracts\OrderCode;
use Illuminate\Support\Facades\Auth;

class ManageOrderCodeService implements OrderCode
{
    public function generateCode(Order $order): string
    {
        $user = $order->user;
        if ($user === null) {
            $user = Auth::user();
        }
        $prefix = uniqid("_");

        return md5($prefix . "|" . $user->id . "|" . $order->id);
    }

    public function getOrderByCode(string $hashCode): ?OrderStatus
    {
        return OrderStatus::where('hash_code', '=', $hashCode)
            ->first();
    }
}
