<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\HospitalSetting;

class HospitalSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HospitalSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'website' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'phone' => $this->faker->phoneNumber,
            'fax' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'country' => $this->faker->country,
            'address' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'extablished' => $this->faker->date(),
            'email' => $this->faker->safeEmail,
            'logo' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'favicon' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'size' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'type' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'facebook' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'twitter' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'whatsapp' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'instagram' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'driver' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'encryption' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'host' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'port' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'username' => $this->faker->userName,
            'email_from' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'email_from_name' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'invoice_prefix' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'invoice_logo' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'user_prefix' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'patient_prefix' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'invoice_number_mode' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'invoice_last_number' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'taxes' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'discount' => $this->faker->regexify('[A-Za-z0-9]{8}'),
        ];
    }
}
