<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Statuses;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'product_id' => 1,
            'status' => Statuses::CREATED->value,
        ];
    }
}
