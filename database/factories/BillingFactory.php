<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Billing;
use App\Models\DoctorOrder;
use App\Models\PatientVisit;
use App\Models\User;

class BillingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Billing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->word,
            'doctor_order_id' => DoctorOrder::factory(),
            'patient_visit_id' => PatientVisit::factory(),
            'approved_by_id' => User::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
