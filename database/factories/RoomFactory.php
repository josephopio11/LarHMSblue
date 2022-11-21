<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use App\Models\Ward;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_no' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'name' => $this->faker->name,
            'price' => $this->faker->randomNumber(),
            'capacity' => $this->faker->randomNumber(),
            'status' => $this->faker->word,
            'image' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'ward_id' => Ward::factory(),
            'room_type_id' => RoomType::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
