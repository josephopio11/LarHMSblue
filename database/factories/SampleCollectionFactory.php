<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Investigation;
use App\Models\Laboratory;
use App\Models\SampleCollection;
use App\Models\User;

class SampleCollectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SampleCollection::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sample_code' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'collect_date' => $this->faker->dateTime(),
            'receive_date' => $this->faker->dateTime(),
            'dispatch_date' => $this->faker->dateTime(),
            'cancel_dispatch_date' => $this->faker->dateTime(),
            'status' => $this->faker->word,
            'investigation_id' => Investigation::factory(),
            'laboratory_id' => Laboratory::factory(),
            'approved_by_id' => User::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
