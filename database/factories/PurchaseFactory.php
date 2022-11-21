<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\MedicineCategory;
use App\Models\MedicineType;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\User;

class PurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'name' => $this->faker->name,
            'type' => $this->faker->word,
            'medicine_generic_name' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'medicine_unit' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'medicine_strength' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'medicine_shelf_life' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'quantity' => $this->faker->randomNumber(),
            'quantity_type' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'price' => $this->faker->randomNumber(),
            'expiry_date' => $this->faker->date(),
            'note' => $this->faker->text,
            'image' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'status' => $this->faker->word,
            'medicine_type_id' => MedicineType::factory(),
            'medicine_category_id' => MedicineCategory::factory(),
            'supplier_id' => Supplier::factory(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
