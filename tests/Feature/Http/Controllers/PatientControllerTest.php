<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Patient;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PatientController
 */
class PatientControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $patients = Patient::factory()->count(3)->create();

        $response = $this->get(route('patient.index'));

        $response->assertOk();
        $response->assertViewIs('patient.index');
        $response->assertViewHas('patients');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('patient.create'));

        $response->assertOk();
        $response->assertViewIs('patient.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PatientController::class,
            'store',
            \App\Http\Requests\PatientStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $referral = $this->faker->randomElement(/** enum_attributes **/);
        $name = $this->faker->name;
        $gender = $this->faker->randomElement(/** enum_attributes **/);
        $same_as_patient = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('patient.store'), [
            'referral' => $referral,
            'name' => $name,
            'gender' => $gender,
            'same_as_patient' => $same_as_patient,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $patients = Patient::query()
            ->where('referral', $referral)
            ->where('name', $name)
            ->where('gender', $gender)
            ->where('same_as_patient', $same_as_patient)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $patients);
        $patient = $patients->first();

        $response->assertRedirect(route('patient.index'));
        $response->assertSessionHas('patient.id', $patient->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $patient = Patient::factory()->create();

        $response = $this->get(route('patient.show', $patient));

        $response->assertOk();
        $response->assertViewIs('patient.show');
        $response->assertViewHas('patient');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $patient = Patient::factory()->create();

        $response = $this->get(route('patient.edit', $patient));

        $response->assertOk();
        $response->assertViewIs('patient.edit');
        $response->assertViewHas('patient');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PatientController::class,
            'update',
            \App\Http\Requests\PatientUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $patient = Patient::factory()->create();
        $referral = $this->faker->randomElement(/** enum_attributes **/);
        $name = $this->faker->name;
        $gender = $this->faker->randomElement(/** enum_attributes **/);
        $same_as_patient = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('patient.update', $patient), [
            'referral' => $referral,
            'name' => $name,
            'gender' => $gender,
            'same_as_patient' => $same_as_patient,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $patient->refresh();

        $response->assertRedirect(route('patient.index'));
        $response->assertSessionHas('patient.id', $patient->id);

        $this->assertEquals($referral, $patient->referral);
        $this->assertEquals($name, $patient->name);
        $this->assertEquals($gender, $patient->gender);
        $this->assertEquals($same_as_patient, $patient->same_as_patient);
        $this->assertEquals($created_by->id, $patient->created_by_id);
        $this->assertEquals($updated_by->id, $patient->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $patient = Patient::factory()->create();

        $response = $this->delete(route('patient.destroy', $patient));

        $response->assertRedirect(route('patient.index'));

        $this->assertModelMissing($patient);
    }
}
