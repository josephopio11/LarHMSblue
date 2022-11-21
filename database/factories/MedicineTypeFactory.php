<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\MedicineType;
use App\Models\User;

class MedicineTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MedicineType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'code' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'status' => $this->faker->word,
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}