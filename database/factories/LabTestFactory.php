<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\LabTest;
use App\Models\User;

class LabTestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LabTest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'name' => $this->faker->name,
            'price' => $this->faker->randomNumber(),
            'percentage' => $this->faker->randomNumber(),
            'status' => $this->faker->word,
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
