<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Immunisation;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\UpdatedBy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ImmunisationController
 */
class ImmunisationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $immunisations = Immunisation::factory()->count(3)->create();

        $response = $this->get(route('immunisation.index'));

        $response->assertOk();
        $response->assertViewIs('immunisation.index');
        $response->assertViewHas('immunisations');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('immunisation.create'));

        $response->assertOk();
        $response->assertViewIs('immunisation.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ImmunisationController::class,
            'store',
            \App\Http\Requests\ImmunisationStoreRequest::class
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

        $response = $this->post(route('immunisation.store'), [
            'status' => $status,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $immunisations = Immunisation::query()
            ->where('status', $status)
            ->where('patient_id', $patient->id)
            ->where('patient_visit_id', $patient_visit->id)
            ->where('user_id', $user->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $immunisations);
        $immunisation = $immunisations->first();

        $response->assertRedirect(route('immunisation.index'));
        $response->assertSessionHas('immunisation.id', $immunisation->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $immunisation = Immunisation::factory()->create();

        $response = $this->get(route('immunisation.show', $immunisation));

        $response->assertOk();
        $response->assertViewIs('immunisation.show');
        $response->assertViewHas('immunisation');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $immunisation = Immunisation::factory()->create();

        $response = $this->get(route('immunisation.edit', $immunisation));

        $response->assertOk();
        $response->assertViewIs('immunisation.edit');
        $response->assertViewHas('immunisation');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ImmunisationController::class,
            'update',
            \App\Http\Requests\ImmunisationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $immunisation = Immunisation::factory()->create();
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('immunisation.update', $immunisation), [
            'status' => $status,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $immunisation->refresh();

        $response->assertRedirect(route('immunisation.index'));
        $response->assertSessionHas('immunisation.id', $immunisation->id);

        $this->assertEquals($status, $immunisation->status);
        $this->assertEquals($patient->id, $immunisation->patient_id);
        $this->assertEquals($patient_visit->id, $immunisation->patient_visit_id);
        $this->assertEquals($user->id, $immunisation->user_id);
        $this->assertEquals($created_by->id, $immunisation->created_by_id);
        $this->assertEquals($updated_by->id, $immunisation->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $immunisation = Immunisation::factory()->create();

        $response = $this->delete(route('immunisation.destroy', $immunisation));

        $response->assertRedirect(route('immunisation.index'));

        $this->assertModelMissing($immunisation);
    }
}
