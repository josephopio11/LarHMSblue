<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\MedicalCertificate;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\UpdatedBy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MedicalCertificateController
 */
class MedicalCertificateControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $medicalCertificates = MedicalCertificate::factory()->count(3)->create();

        $response = $this->get(route('medical-certificate.index'));

        $response->assertOk();
        $response->assertViewIs('medicalCertificate.index');
        $response->assertViewHas('medicalCertificates');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('medical-certificate.create'));

        $response->assertOk();
        $response->assertViewIs('medicalCertificate.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MedicalCertificateController::class,
            'store',
            \App\Http\Requests\MedicalCertificateStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $finalised = $this->faker->word;
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('medical-certificate.store'), [
            'finalised' => $finalised,
            'status' => $status,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $medicalCertificates = MedicalCertificate::query()
            ->where('finalised', $finalised)
            ->where('status', $status)
            ->where('patient_id', $patient->id)
            ->where('patient_visit_id', $patient_visit->id)
            ->where('user_id', $user->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $medicalCertificates);
        $medicalCertificate = $medicalCertificates->first();

        $response->assertRedirect(route('medicalCertificate.index'));
        $response->assertSessionHas('medicalCertificate.id', $medicalCertificate->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $medicalCertificate = MedicalCertificate::factory()->create();

        $response = $this->get(route('medical-certificate.show', $medicalCertificate));

        $response->assertOk();
        $response->assertViewIs('medicalCertificate.show');
        $response->assertViewHas('medicalCertificate');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $medicalCertificate = MedicalCertificate::factory()->create();

        $response = $this->get(route('medical-certificate.edit', $medicalCertificate));

        $response->assertOk();
        $response->assertViewIs('medicalCertificate.edit');
        $response->assertViewHas('medicalCertificate');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MedicalCertificateController::class,
            'update',
            \App\Http\Requests\MedicalCertificateUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $medicalCertificate = MedicalCertificate::factory()->create();
        $finalised = $this->faker->word;
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('medical-certificate.update', $medicalCertificate), [
            'finalised' => $finalised,
            'status' => $status,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $medicalCertificate->refresh();

        $response->assertRedirect(route('medicalCertificate.index'));
        $response->assertSessionHas('medicalCertificate.id', $medicalCertificate->id);

        $this->assertEquals($finalised, $medicalCertificate->finalised);
        $this->assertEquals($status, $medicalCertificate->status);
        $this->assertEquals($patient->id, $medicalCertificate->patient_id);
        $this->assertEquals($patient_visit->id, $medicalCertificate->patient_visit_id);
        $this->assertEquals($user->id, $medicalCertificate->user_id);
        $this->assertEquals($created_by->id, $medicalCertificate->created_by_id);
        $this->assertEquals($updated_by->id, $medicalCertificate->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $medicalCertificate = MedicalCertificate::factory()->create();

        $response = $this->delete(route('medical-certificate.destroy', $medicalCertificate));

        $response->assertRedirect(route('medicalCertificate.index'));

        $this->assertModelMissing($medicalCertificate);
    }
}
