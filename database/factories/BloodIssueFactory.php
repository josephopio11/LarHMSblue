<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BloodIssue;
use App\Models\BloodRequest;
use App\Models\BloodStockDetail;
use App\Models\User;

class BloodIssueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BloodIssue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unit' => $this->faker->randomNumber(),
            'status' => $this->faker->word,
            'blood_request_id' => BloodRequest::factory(),
            'blood_stock_detail_id' => BloodStockDetail::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
