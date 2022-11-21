<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Patient;
use App\Models\User;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'registration_no' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'registration_date' => $this->faker->date(),
            'referral' => $this->faker->randomElement(["Yes","No"]),
            'referred_by' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'patient_type' => $this->faker->randomElement(["Inpatient","Outpatient"]),
            'title' => $this->faker->randomElement(["Mr","Mrs","Miss","Dr","Prof"]),
            'name' => $this->faker->name,
            'dob' => $this->faker->date(),
            'gender' => $this->faker->randomElement(["M","F"]),
            'marital_status' => $this->faker->randomElement(["Single","Married","Divorced",""]),
            'blood_group' => $this->faker->randomElement(["A+","A-","B+","B-","AB+","AB-","O+","O-"]),
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'religion' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'occupation' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'country' => $this->faker->country,
            'home_phone' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'home_address' => $this->faker->text,
            'fathers_name' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'fathers_phone' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'fathers_address' => $this->faker->text,
            'mothers_name' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'mothers_phone' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'mothers_address' => $this->faker->text,
            'same_as_patient' => $this->faker->word,
            'next_of_kin_phone' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'next_of_kin_email' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'next_of_kin_address' => $this->faker->text,
            'payment_method' => $this->faker->randomElement(["Cash","Card","Cheque"]),
            'symptoms' => $this->faker->text,
            'image' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
