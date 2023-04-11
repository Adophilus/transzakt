<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TransactionFactory extends Factory
{
    private $TRANSACTION_TYPES = ["CREDIT", "DEBIT"];
    private $TRANSACTION_STATUSES = ['FULFILLED', 'PENDING', 'CANCELLED', 'BLOCKED'];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'user_id' => User::inRandomOrder()->first(),
            'amount' => rand(10000, 99999),
            'type' => Arr::random($this->TRANSACTION_TYPES),
            'status' => Arr::random($this->TRANSACTION_STATUSES),
        ];
    }
}
