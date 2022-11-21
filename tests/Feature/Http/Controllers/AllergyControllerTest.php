<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Allergy;
use App\Models\CreatedBy;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\UpdatedBy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AllergyController
 */
class AllergyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $allergies = Allergy::factory()->count(3)->create();

        $response = $this->get(route('allergy.index'));

        $response->assertOk();
        $response->assertViewIs('allergy.index');
        $response->assertViewHas('allergies');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('allergy.create'));

        $response->assertOk();
        $response->assertViewIs('allergy.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AllergyController::class,
            'store',
            \App\Http\Requests\AllergyStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('allergy.store'), [
            'status' => $status,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $allergies = Allergy::query()
            ->where('status', $status)
            ->where('patient_id', $patient->id)
            ->where('patient_visit_id', $patient_visit->id)
            ->where('user_id', $user->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $allergies);
        $allergy = $allergies->first();

        $response->assertRedirect(route('allergy.index'));
        $response->assertSessionHas('allergy.id', $allergy->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $allergy = Allergy::factory()->create();

        $response = $this->get(route('allergy.show', $allergy));

        $response->assertOk();
        $response->assertViewIs('allergy.show');
        $response->assertViewHas('allergy');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $allergy = Allergy::factory()->create();

        $response = $this->get(route('allergy.edit', $allergy));

        $response->assertOk();
        $response->assertViewIs('allergy.edit');
        $response->assertViewHas('allergy');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AllergyController::class,
            'update',
            \App\Http\Requests\AllergyUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $allergy = Allergy::factory()->create();
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('allergy.update', $allergy), [
            'status' => $status,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $allergy->refresh();

        $response->assertRedirect(route('allergy.index'));
        $response->assertSessionHas('allergy.id', $allergy->id);

        $this->assertEquals($status, $allergy->status);
        $this->assertEquals($patient->id, $allergy->patient_id);
        $this->assertEquals($patient_visit->id, $allergy->patient_visit_id);
        $this->assertEquals($user->id, $allergy->user_id);
        $this->assertEquals($created_by->id, $allergy->created_by_id);
        $this->assertEquals($updated_by->id, $allergy->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $allergy = Allergy::factory()->create();

        $response = $this->delete(route('allergy.destroy', $allergy));

        $response->assertRedirect(route('allergy.index'));

        $this->assertModelMissing($allergy);
    }
}
