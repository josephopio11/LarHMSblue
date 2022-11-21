<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PharmacyInvoice;
use App\Models\PharmacyInvoiceDetail;
use App\Models\User;

class PharmacyInvoiceDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PharmacyInvoiceDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_amount' => $this->faker->randomNumber(),
            'item_total_amount' => $this->faker->randomNumber(),
            'pharmacy_invoice_id' => PharmacyInvoice::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
