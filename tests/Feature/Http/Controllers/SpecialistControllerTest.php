<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Specialist;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SpecialistController
 */
class SpecialistControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $specialists = Specialist::factory()->count(3)->create();

        $response = $this->get(route('specialist.index'));

        $response->assertOk();
        $response->assertViewIs('specialist.index');
        $response->assertViewHas('specialists');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('specialist.create'));

        $response->assertOk();
        $response->assertViewIs('specialist.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SpecialistController::class,
            'store',
            \App\Http\Requests\SpecialistStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('specialist.store'), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $specialists = Specialist::query()
            ->where('status', $status)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $specialists);
        $specialist = $specialists->first();

        $response->assertRedirect(route('specialist.index'));
        $response->assertSessionHas('specialist.id', $specialist->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $specialist = Specialist::factory()->create();

        $response = $this->get(route('specialist.show', $specialist));

        $response->assertOk();
        $response->assertViewIs('specialist.show');
        $response->assertViewHas('specialist');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $specialist = Specialist::factory()->create();

        $response = $this->get(route('specialist.edit', $specialist));

        $response->assertOk();
        $response->assertViewIs('specialist.edit');
        $response->assertViewHas('specialist');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SpecialistController::class,
            'update',
            \App\Http\Requests\SpecialistUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $specialist = Specialist::factory()->create();
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('specialist.update', $specialist), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $specialist->refresh();

        $response->assertRedirect(route('specialist.index'));
        $response->assertSessionHas('specialist.id', $specialist->id);

        $this->assertEquals($status, $specialist->status);
        $this->assertEquals($created_by->id, $specialist->created_by_id);
        $this->assertEquals($updated_by->id, $specialist->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $specialist = Specialist::factory()->create();

        $response = $this->delete(route('specialist.destroy', $specialist));

        $response->assertRedirect(route('specialist.index'));

        $this->assertModelMissing($specialist);
    }
}
