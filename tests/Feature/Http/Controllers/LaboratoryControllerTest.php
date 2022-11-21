<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Laboratory;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LaboratoryController
 */
class LaboratoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $laboratories = Laboratory::factory()->count(3)->create();

        $response = $this->get(route('laboratory.index'));

        $response->assertOk();
        $response->assertViewIs('laboratory.index');
        $response->assertViewHas('laboratories');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('laboratory.create'));

        $response->assertOk();
        $response->assertViewIs('laboratory.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LaboratoryController::class,
            'store',
            \App\Http\Requests\LaboratoryStoreRequest::class
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

        $response = $this->post(route('laboratory.store'), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $laboratories = Laboratory::query()
            ->where('status', $status)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $laboratories);
        $laboratory = $laboratories->first();

        $response->assertRedirect(route('laboratory.index'));
        $response->assertSessionHas('laboratory.id', $laboratory->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $laboratory = Laboratory::factory()->create();

        $response = $this->get(route('laboratory.show', $laboratory));

        $response->assertOk();
        $response->assertViewIs('laboratory.show');
        $response->assertViewHas('laboratory');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $laboratory = Laboratory::factory()->create();

        $response = $this->get(route('laboratory.edit', $laboratory));

        $response->assertOk();
        $response->assertViewIs('laboratory.edit');
        $response->assertViewHas('laboratory');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LaboratoryController::class,
            'update',
            \App\Http\Requests\LaboratoryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $laboratory = Laboratory::factory()->create();
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('laboratory.update', $laboratory), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $laboratory->refresh();

        $response->assertRedirect(route('laboratory.index'));
        $response->assertSessionHas('laboratory.id', $laboratory->id);

        $this->assertEquals($status, $laboratory->status);
        $this->assertEquals($created_by->id, $laboratory->created_by_id);
        $this->assertEquals($updated_by->id, $laboratory->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $laboratory = Laboratory::factory()->create();

        $response = $this->delete(route('laboratory.destroy', $laboratory));

        $response->assertRedirect(route('laboratory.index'));

        $this->assertModelMissing($laboratory);
    }
}
