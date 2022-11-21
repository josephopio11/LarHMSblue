<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Investigation;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\TestType;
use App\Models\User;

class InvestigationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Investigation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stat' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'ot_required' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'result' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'status' => $this->faker->word,
            'test_type_id' => TestType::factory(),
            'patient_id' => Patient::factory(),
            'patient_visit_id' => PatientVisit::factory(),
            'user_id' => User::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
