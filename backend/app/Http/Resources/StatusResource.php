<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->order->id,
            'status' => $this->order->status,
            'hash_code' => $this->hash_code,
            'is_rent' => $this->is_rent,
            'term_rent' => $this->term_rent,
            'term_rent_at' => $this->term_rent_at,
        ];
    }
}
