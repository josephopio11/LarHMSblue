<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\Prescription;
use App\Models\UpdatedBy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PrescriptionController
 */
class PrescriptionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $prescriptions = Prescription::factory()->count(3)->create();

        $response = $this->get(route('prescription.index'));

        $response->assertOk();
        $response->assertViewIs('prescription.index');
        $response->assertViewHas('prescriptions');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('prescription.create'));

        $response->assertOk();
        $response->assertViewIs('prescription.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PrescriptionController::class,
            'store',
            \App\Http\Requests\PrescriptionStoreRequest::class
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
        $medicine = Medicine::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('prescription.store'), [
            'status' => $status,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'medicine_id' => $medicine->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $prescriptions = Prescription::query()
            ->where('status', $status)
            ->where('patient_id', $patient->id)
            ->where('patient_visit_id', $patient_visit->id)
            ->where('user_id', $user->id)
            ->where('medicine_id', $medicine->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $prescriptions);
        $prescription = $prescriptions->first();

        $response->assertRedirect(route('prescription.index'));
        $response->assertSessionHas('prescription.id', $prescription->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $prescription = Prescription::factory()->create();

        $response = $this->get(route('prescription.show', $prescription));

        $response->assertOk();
        $response->assertViewIs('prescription.show');
        $response->assertViewHas('prescription');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $prescription = Prescription::factory()->create();

        $response = $this->get(route('prescription.edit', $prescription));

        $response->assertOk();
        $response->assertViewIs('prescription.edit');
        $response->assertViewHas('prescription');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PrescriptionController::class,
            'update',
            \App\Http\Requests\PrescriptionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $prescription = Prescription::factory()->create();
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $user = User::factory()->create();
        $medicine = Medicine::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('prescription.update', $prescription), [
            'status' => $status,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'medicine_id' => $medicine->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $prescription->refresh();

        $response->assertRedirect(route('prescription.index'));
        $response->assertSessionHas('prescription.id', $prescription->id);

        $this->assertEquals($status, $prescription->status);
        $this->assertEquals($patient->id, $prescription->patient_id);
        $this->assertEquals($patient_visit->id, $prescription->patient_visit_id);
        $this->assertEquals($user->id, $prescription->user_id);
        $this->assertEquals($medicine->id, $prescription->medicine_id);
        $this->assertEquals($created_by->id, $prescription->created_by_id);
        $this->assertEquals($updated_by->id, $prescription->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $prescription = Prescription::factory()->create();

        $response = $this->delete(route('prescription.destroy', $prescription));

        $response->assertRedirect(route('prescription.index'));

        $this->assertModelMissing($prescription);
    }
}
