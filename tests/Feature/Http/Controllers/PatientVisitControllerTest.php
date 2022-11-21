<?php

namespace Tests\Feature\Http\Controllers;

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
 * @see \App\Http\Controllers\PatientVisitController
 */
class PatientVisitControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $patientVisits = PatientVisit::factory()->count(3)->create();

        $response = $this->get(route('patient-visit.index'));

        $response->assertOk();
        $response->assertViewIs('patientVisit.index');
        $response->assertViewHas('patientVisits');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('patient-visit.create'));

        $response->assertOk();
        $response->assertViewIs('patientVisit.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PatientVisitController::class,
            'store',
            \App\Http\Requests\PatientVisitStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $patient = Patient::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('patient-visit.store'), [
            'patient_id' => $patient->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $patientVisits = PatientVisit::query()
            ->where('patient_id', $patient->id)
            ->where('user_id', $user->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $patientVisits);
        $patientVisit = $patientVisits->first();

        $response->assertRedirect(route('patientVisit.index'));
        $response->assertSessionHas('patientVisit.id', $patientVisit->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $patientVisit = PatientVisit::factory()->create();

        $response = $this->get(route('patient-visit.show', $patientVisit));

        $response->assertOk();
        $response->assertViewIs('patientVisit.show');
        $response->assertViewHas('patientVisit');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $patientVisit = PatientVisit::factory()->create();

        $response = $this->get(route('patient-visit.edit', $patientVisit));

        $response->assertOk();
        $response->assertViewIs('patientVisit.edit');
        $response->assertViewHas('patientVisit');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PatientVisitController::class,
            'update',
            \App\Http\Requests\PatientVisitUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $patientVisit = PatientVisit::factory()->create();
        $patient = Patient::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('patient-visit.update', $patientVisit), [
            'patient_id' => $patient->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $patientVisit->refresh();

        $response->assertRedirect(route('patientVisit.index'));
        $response->assertSessionHas('patientVisit.id', $patientVisit->id);

        $this->assertEquals($patient->id, $patientVisit->patient_id);
        $this->assertEquals($user->id, $patientVisit->user_id);
        $this->assertEquals($created_by->id, $patientVisit->created_by_id);
        $this->assertEquals($updated_by->id, $patientVisit->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $patientVisit = PatientVisit::factory()->create();

        $response = $this->delete(route('patient-visit.destroy', $patientVisit));

        $response->assertRedirect(route('patientVisit.index'));

        $this->assertModelMissing($patientVisit);
    }
}
