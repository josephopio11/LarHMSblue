<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BloodStock;
use App\Models\BloodStockDetail;
use App\Models\User;

class BloodStockDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BloodStockDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unit' => $this->faker->randomNumber(),
            'total' => $this->faker->randomNumber(),
            'balance' => $this->faker->randomNumber(),
            'blood_stock_id' => BloodStock::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
