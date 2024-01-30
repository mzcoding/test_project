<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\Order;
use App\Services\Contracts\OrderCode;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatedOrderListener
{
   private OrderCode $orderCode;
    /**
     * Create the event listener.
     */
    public function __construct(OrderCode $orderCode)
    {
        $this->orderCode = $orderCode;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event->order instanceof Order) {
            $event->order->orderStatus()->create([
                'hash_code' => $this->orderCode->generateCode($event->order),
                'is_rent' => $event->additionalData['is_rent'],
                'term_rent' => $event->additionalData['term_rent'],
                'term_rent_at' => $event->additionalData['term_rent_at'],
            ]);
        }
    }
}
