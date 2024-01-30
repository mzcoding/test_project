<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StatusFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => 1,
            'hash_code' => Hash::make(Str::random(10)),
            'is_rent' => false,
            'term_rent' => null,
            'term_rent_at' => null,
        ];
    }
}
