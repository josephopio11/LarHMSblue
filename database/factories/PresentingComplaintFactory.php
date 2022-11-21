<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\PresentingComplaint;
use App\Models\User;

class PresentingComplaintFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PresentingComplaint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'presenting_complaint_type' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'presenting_complaint' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'status' => $this->faker->word,
            'patient_id' => Patient::factory(),
            'patient_visit_id' => PatientVisit::factory(),
            'user_id' => User::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
