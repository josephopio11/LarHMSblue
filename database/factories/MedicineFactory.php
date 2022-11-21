<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Medicine;
use App\Models\Purchase;
use App\Models\User;

class MedicineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medicine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'medicine_code' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'medicine_name' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'medicine_price' => $this->faker->randomNumber(),
            'medicine_profit' => $this->faker->randomNumber(),
            'description' => $this->faker->text,
            'available_quantity' => $this->faker->randomNumber(),
            'alert_quantity' => $this->faker->randomNumber(),
            'status' => $this->faker->word,
            'purchase_id' => Purchase::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
