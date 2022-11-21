<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\PresentingComplaint;
use App\Models\UpdatedBy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PresentingComplaintController
 */
class PresentingComplaintControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $presentingComplaints = PresentingComplaint::factory()->count(3)->create();

        $response = $this->get(route('presenting-complaint.index'));

        $response->assertOk();
        $response->assertViewIs('presentingComplaint.index');
        $response->assertViewHas('presentingComplaints');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('presenting-complaint.create'));

        $response->assertOk();
        $response->assertViewIs('presentingComplaint.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PresentingComplaintController::class,
            'store',
            \App\Http\Requests\PresentingComplaintStoreRequest::class
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

        $response = $this->post(route('presenting-complaint.store'), [
            'status' => $status,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $presentingComplaints = PresentingComplaint::query()
            ->where('status', $status)
            ->where('patient_id', $patient->id)
            ->where('patient_visit_id', $patient_visit->id)
            ->where('user_id', $user->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $presentingComplaints);
        $presentingComplaint = $presentingComplaints->first();

        $response->assertRedirect(route('presentingComplaint.index'));
        $response->assertSessionHas('presentingComplaint.id', $presentingComplaint->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $presentingComplaint = PresentingComplaint::factory()->create();

        $response = $this->get(route('presenting-complaint.show', $presentingComplaint));

        $response->assertOk();
        $response->assertViewIs('presentingComplaint.show');
        $response->assertViewHas('presentingComplaint');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $presentingComplaint = PresentingComplaint::factory()->create();

        $response = $this->get(route('presenting-complaint.edit', $presentingComplaint));

        $response->assertOk();
        $response->assertViewIs('presentingComplaint.edit');
        $response->assertViewHas('presentingComplaint');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PresentingComplaintController::class,
            'update',
            \App\Http\Requests\PresentingComplaintUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $presentingComplaint = PresentingComplaint::factory()->create();
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('presenting-complaint.update', $presentingComplaint), [
            'status' => $status,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $presentingComplaint->refresh();

        $response->assertRedirect(route('presentingComplaint.index'));
        $response->assertSessionHas('presentingComplaint.id', $presentingComplaint->id);

        $this->assertEquals($status, $presentingComplaint->status);
        $this->assertEquals($patient->id, $presentingComplaint->patient_id);
        $this->assertEquals($patient_visit->id, $presentingComplaint->patient_visit_id);
        $this->assertEquals($user->id, $presentingComplaint->user_id);
        $this->assertEquals($created_by->id, $presentingComplaint->created_by_id);
        $this->assertEquals($updated_by->id, $presentingComplaint->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $presentingComplaint = PresentingComplaint::factory()->create();

        $response = $this->delete(route('presenting-complaint.destroy', $presentingComplaint));

        $response->assertRedirect(route('presentingComplaint.index'));

        $this->assertModelMissing($presentingComplaint);
    }
}
