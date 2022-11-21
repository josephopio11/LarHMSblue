<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\User;

class PatientVisitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PatientVisit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'visit_no' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'visit_type' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'visit_date' => $this->faker->date(),
            'visit:status' => $this->faker->randomElement(["Admitted","Discharged","Pending"]),
            'description' => $this->faker->text,
            'patient_id' => Patient::factory(),
            'user_id' => User::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
