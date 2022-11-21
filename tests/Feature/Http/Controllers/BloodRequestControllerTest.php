<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\BloodRequest;
use App\Models\CreatedBy;
use App\Models\Patient;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BloodRequestController
 */
class BloodRequestControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $bloodRequests = BloodRequest::factory()->count(3)->create();

        $response = $this->get(route('blood-request.index'));

        $response->assertOk();
        $response->assertViewIs('bloodRequest.index');
        $response->assertViewHas('bloodRequests');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('blood-request.create'));

        $response->assertOk();
        $response->assertViewIs('bloodRequest.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BloodRequestController::class,
            'store',
            \App\Http\Requests\BloodRequestStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $unit = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('blood-request.store'), [
            'unit' => $unit,
            'status' => $status,
            'patient_id' => $patient->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $bloodRequests = BloodRequest::query()
            ->where('unit', $unit)
            ->where('status', $status)
            ->where('patient_id', $patient->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $bloodRequests);
        $bloodRequest = $bloodRequests->first();

        $response->assertRedirect(route('bloodRequest.index'));
        $response->assertSessionHas('bloodRequest.id', $bloodRequest->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $bloodRequest = BloodRequest::factory()->create();

        $response = $this->get(route('blood-request.show', $bloodRequest));

        $response->assertOk();
        $response->assertViewIs('bloodRequest.show');
        $response->assertViewHas('bloodRequest');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $bloodRequest = BloodRequest::factory()->create();

        $response = $this->get(route('blood-request.edit', $bloodRequest));

        $response->assertOk();
        $response->assertViewIs('bloodRequest.edit');
        $response->assertViewHas('bloodRequest');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BloodRequestController::class,
            'update',
            \App\Http\Requests\BloodRequestUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $bloodRequest = BloodRequest::factory()->create();
        $unit = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('blood-request.update', $bloodRequest), [
            'unit' => $unit,
            'status' => $status,
            'patient_id' => $patient->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $bloodRequest->refresh();

        $response->assertRedirect(route('bloodRequest.index'));
        $response->assertSessionHas('bloodRequest.id', $bloodRequest->id);

        $this->assertEquals($unit, $bloodRequest->unit);
        $this->assertEquals($status, $bloodRequest->status);
        $this->assertEquals($patient->id, $bloodRequest->patient_id);
        $this->assertEquals($created_by->id, $bloodRequest->created_by_id);
        $this->assertEquals($updated_by->id, $bloodRequest->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $bloodRequest = BloodRequest::factory()->create();

        $response = $this->delete(route('blood-request.destroy', $bloodRequest));

        $response->assertRedirect(route('bloodRequest.index'));

        $this->assertModelMissing($bloodRequest);
    }
}
