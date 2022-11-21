<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\DoctorOrder;
use App\Models\PatientVisit;
use App\Models\User;

class DoctorOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DoctorOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_no' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'order_type' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'status' => $this->faker->word,
            'patient_visit_id' => PatientVisit::factory(),
            'user_id' => User::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
