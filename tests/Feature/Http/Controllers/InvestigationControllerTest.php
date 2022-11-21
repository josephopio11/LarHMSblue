<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Investigation;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\TestType;
use App\Models\UpdatedBy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\InvestigationController
 */
class InvestigationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $investigations = Investigation::factory()->count(3)->create();

        $response = $this->get(route('investigation.index'));

        $response->assertOk();
        $response->assertViewIs('investigation.index');
        $response->assertViewHas('investigations');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('investigation.create'));

        $response->assertOk();
        $response->assertViewIs('investigation.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InvestigationController::class,
            'store',
            \App\Http\Requests\InvestigationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $status = $this->faker->word;
        $test_type = TestType::factory()->create();
        $patient = Patient::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('investigation.store'), [
            'status' => $status,
            'test_type_id' => $test_type->id,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $investigations = Investigation::query()
            ->where('status', $status)
            ->where('test_type_id', $test_type->id)
            ->where('patient_id', $patient->id)
            ->where('patient_visit_id', $patient_visit->id)
            ->where('user_id', $user->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $investigations);
        $investigation = $investigations->first();

        $response->assertRedirect(route('investigation.index'));
        $response->assertSessionHas('investigation.id', $investigation->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $investigation = Investigation::factory()->create();

        $response = $this->get(route('investigation.show', $investigation));

        $response->assertOk();
        $response->assertViewIs('investigation.show');
        $response->assertViewHas('investigation');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $investigation = Investigation::factory()->create();

        $response = $this->get(route('investigation.edit', $investigation));

        $response->assertOk();
        $response->assertViewIs('investigation.edit');
        $response->assertViewHas('investigation');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InvestigationController::class,
            'update',
            \App\Http\Requests\InvestigationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $investigation = Investigation::factory()->create();
        $status = $this->faker->word;
        $test_type = TestType::factory()->create();
        $patient = Patient::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('investigation.update', $investigation), [
            'status' => $status,
            'test_type_id' => $test_type->id,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $investigation->refresh();

        $response->assertRedirect(route('investigation.index'));
        $response->assertSessionHas('investigation.id', $investigation->id);

        $this->assertEquals($status, $investigation->status);
        $this->assertEquals($test_type->id, $investigation->test_type_id);
        $this->assertEquals($patient->id, $investigation->patient_id);
        $this->assertEquals($patient_visit->id, $investigation->patient_visit_id);
        $this->assertEquals($user->id, $investigation->user_id);
        $this->assertEquals($created_by->id, $investigation->created_by_id);
        $this->assertEquals($updated_by->id, $investigation->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $investigation = Investigation::factory()->create();

        $response = $this->delete(route('investigation.destroy', $investigation));

        $response->assertRedirect(route('investigation.index'));

        $this->assertModelMissing($investigation);
    }
}
