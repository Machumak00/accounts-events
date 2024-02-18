<?php

namespace Database\Factories;

use App\Models\AccountEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AccountEvent>
 */
class AccountEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_id' => $this->faker->randomNumber(),
            'event_id' => $this->faker->randomNumber(),
        ];
    }
}
