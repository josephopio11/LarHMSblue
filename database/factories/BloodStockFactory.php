<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BloodBank;
use App\Models\BloodStock;
use App\Models\User;

class BloodStockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BloodStock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'blood_group' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'blood_bank_id' => BloodBank::factory(),
            'unit' => $this->faker->randomNumber(),
            'status' => $this->faker->word,
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
