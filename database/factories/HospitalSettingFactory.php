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
            'website' => $this->faker->url,
            'phone' => $this->faker->phoneNumber,
            'fax' => $this->faker->phoneNumber,
            'country' => $this->faker->country,
            'address' => $this->faker->address,
            'extablished' => $this->faker->date(),
            'email' => $this->faker->safeEmail,
            'logo' => $this->faker->imageUrl(),
            'favicon' => $this->faker->imageUrl(),
            'size' => $this->faker->randomNumber(),
            'type' => $this->faker->word,
            'facebook' => $this->faker->url,
            'twitter' => $this->faker->url,
            'whatsapp' => $this->faker->url,
            'instagram' => $this->faker->url,
            'driver' => $this->faker->randomElement(['mysql', 'pgsql', 'sqlite', 'sqlsrv']),
            'encryption' => $this->faker->regexify('[A-Za-z0-9]{3}'),
            'host' => $this->faker->url,
            'port' => $this->faker->randomNumber(4),
            'username' => $this->faker->userName,
            'email_from' => $this->faker->safeEmail,
            'email_from_name' => $this->faker->name,
            'invoice_prefix' => $this->faker->regexify('[A-Za-z0-9]{2}'),
            'invoice_logo' => $this->faker->imageUrl(),
            'user_prefix' => $this->faker->regexify('[A-Za-z0-9]{2}'),
            'patient_prefix' => $this->faker->regexify('[A-Za-z0-9]{2}'),
            'invoice_number_mode' => $this->faker->regexify('[0-9]{2}'),
            'invoice_last_number' => $this->faker->regexify('[0-9]{8}'),
            'taxes' => $this->faker->randomNumber(2),
            'discount' => $this->faker->randomNumber(2),
        ];
    }
}
