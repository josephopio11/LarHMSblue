<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Bed;
use App\Models\BedType;
use App\Models\Room;
use App\Models\User;

class BedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bed::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bed_no' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'name' => $this->faker->name,
            'price' => $this->faker->randomNumber(),
            'status' => $this->faker->word,
            'image' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'room_id' => Room::factory(),
            'bed_type_id' => BedType::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
