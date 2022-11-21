<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\PatientRecord;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PatientRecordController
 */
class PatientRecordControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $patientRecords = PatientRecord::factory()->count(3)->create();

        $response = $this->get(route('patient-record.index'));

        $response->assertOk();
        $response->assertViewIs('patientRecord.index');
        $response->assertViewHas('patientRecords');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('patient-record.create'));

        $response->assertOk();
        $response->assertViewIs('patientRecord.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PatientRecordController::class,
            'store',
            \App\Http\Requests\PatientRecordStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $softDelete = $this->faker->word;

        $response = $this->post(route('patient-record.store'), [
            'softDelete' => $softDelete,
        ]);

        $patientRecords = PatientRecord::query()
            ->where('softDelete', $softDelete)
            ->get();
        $this->assertCount(1, $patientRecords);
        $patientRecord = $patientRecords->first();

        $response->assertRedirect(route('patientRecord.index'));
        $response->assertSessionHas('patientRecord.id', $patientRecord->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $patientRecord = PatientRecord::factory()->create();

        $response = $this->get(route('patient-record.show', $patientRecord));

        $response->assertOk();
        $response->assertViewIs('patientRecord.show');
        $response->assertViewHas('patientRecord');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $patientRecord = PatientRecord::factory()->create();

        $response = $this->get(route('patient-record.edit', $patientRecord));

        $response->assertOk();
        $response->assertViewIs('patientRecord.edit');
        $response->assertViewHas('patientRecord');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PatientRecordController::class,
            'update',
            \App\Http\Requests\PatientRecordUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $patientRecord = PatientRecord::factory()->create();
        $softDelete = $this->faker->word;

        $response = $this->put(route('patient-record.update', $patientRecord), [
            'softDelete' => $softDelete,
        ]);

        $patientRecord->refresh();

        $response->assertRedirect(route('patientRecord.index'));
        $response->assertSessionHas('patientRecord.id', $patientRecord->id);

        $this->assertEquals($softDelete, $patientRecord->softDelete);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $patientRecord = PatientRecord::factory()->create();

        $response = $this->delete(route('patient-record.destroy', $patientRecord));

        $response->assertRedirect(route('patientRecord.index'));

        $this->assertModelMissing($patientRecord);
    }
}
