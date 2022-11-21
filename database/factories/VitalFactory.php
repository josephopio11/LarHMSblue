<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\User;
use App\Models\Vital;

class VitalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vital::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'systolic_b_p' => $this->faker->randomNumber(),
            'diastolic_b_p' => $this->faker->randomNumber(),
            'temperature' => $this->faker->randomNumber(),
            'weight' => $this->faker->randomNumber(),
            'height' => $this->faker->randomNumber(),
            'pulse' => $this->faker->randomNumber(),
            'respiratory_rate' => $this->faker->randomNumber(),
            'heart_rate' => $this->faker->randomNumber(),
            'urine_output' => $this->faker->randomNumber(),
            'blood_sugar_r' => $this->faker->randomNumber(),
            'blood_sugar_f' => $this->faker->randomNumber(),
            'spo_2' => $this->faker->randomNumber(),
            'avpu' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'trauma' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'mobility' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'oxygen_supplement' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'comment' => $this->faker->text,
            'status' => $this->faker->word,
            'patient_id' => Patient::factory(),
            'patient_visit_id' => PatientVisit::factory(),
            'user_id' => User::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
