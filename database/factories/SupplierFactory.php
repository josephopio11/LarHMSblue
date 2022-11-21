<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Supplier;
use App\Models\User;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'code' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->text,
            'company' => $this->faker->company,
            'product' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'description' => $this->faker->text,
            'status' => $this->faker->word,
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
