<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\Prescription;
use App\Models\User;

class PrescriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prescription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dosage' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'frequency' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'duration' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'food_relation' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'route' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'instruction' => $this->faker->text,
            'status' => $this->faker->word,
            'patient_id' => Patient::factory(),
            'patient_visit_id' => PatientVisit::factory(),
            'user_id' => User::factory(),
            'medicine_id' => Medicine::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
