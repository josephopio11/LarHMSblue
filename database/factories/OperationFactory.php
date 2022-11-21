<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Operation;
use App\Models\OperationType;
use App\Models\Patient;
use App\Models\User;

class OperationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Operation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'operation_date' => $this->faker->date(),
            'operation_time' => $this->faker->time(),
            'amount' => $this->faker->randomNumber(),
            'description' => $this->faker->text,
            'status' => $this->faker->word,
            'operation_type_id' => OperationType::factory(),
            'patient_id' => Patient::factory(),
            'user_id' => User::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
