<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BillingInvoice;
use App\Models\BillingInvoiceDetail;
use App\Models\User;

class BillingInvoiceDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BillingInvoiceDetail::class;

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
            'billing_invoice_id' => BillingInvoice::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
