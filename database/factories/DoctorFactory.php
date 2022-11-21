<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\User;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'about_doctor' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'charge' => $this->faker->randomNumber(),
            'experience' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'status' => $this->faker->word,
            'user_id' => User::factory(),
            'specialist_id' => Specialist::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
