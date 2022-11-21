<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PatientVisit;
use App\Models\PharmacyInvoice;
use App\Models\PharmacyTransaction;
use App\Models\User;

class PharmacyTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PharmacyTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'payment_amount' => $this->faker->randomNumber(),
            'payment_mode' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'status' => $this->faker->word,
            'patient_visit_id' => PatientVisit::factory(),
            'pharmacy_invoice_id' => PharmacyInvoice::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
