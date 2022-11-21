<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\DoctorOrder;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\PharmacyInvoice;
use App\Models\User;

class PharmacyInvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PharmacyInvoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_no' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'total' => $this->faker->randomNumber(),
            'pending_amount' => $this->faker->randomNumber(),
            'paid_amount' => $this->faker->randomNumber(),
            'mode' => $this->faker->word,
            'discount_type' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'discount_amount' => $this->faker->randomNumber(),
            'discount_note' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'note' => $this->faker->text,
            'tax' => $this->faker->randomNumber(),
            'additional_charge' => $this->faker->randomNumber(),
            'status' => $this->faker->word,
            'patient_id' => Patient::factory(),
            'patient_visit_id' => PatientVisit::factory(),
            'doctor_order_id' => DoctorOrder::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
