<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BloodRequest;
use App\Models\Patient;
use App\Models\User;

class BloodRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BloodRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reason' => $this->faker->text,
            'blood_type' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'unit' => $this->faker->randomNumber(),
            'status' => $this->faker->word,
            'patient_id' => Patient::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
