<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BillingTransaction;
use App\Models\ChequeDetail;
use App\Models\User;

class ChequeDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChequeDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cheque_no' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'cheque_date' => $this->faker->date(),
            'bank_name' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'status' => $this->faker->word,
            'billing_transaction_id' => BillingTransaction::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
