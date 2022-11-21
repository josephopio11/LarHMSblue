<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Radiology;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RadiologyController
 */
class RadiologyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $radiologies = Radiology::factory()->count(3)->create();

        $response = $this->get(route('radiology.index'));

        $response->assertOk();
        $response->assertViewIs('radiology.index');
        $response->assertViewHas('radiologies');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('radiology.create'));

        $response->assertOk();
        $response->assertViewIs('radiology.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RadiologyController::class,
            'store',
            \App\Http\Requests\RadiologyStoreRequest::class
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

        $response = $this->post(route('radiology.store'), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $radiologies = Radiology::query()
            ->where('status', $status)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $radiologies);
        $radiology = $radiologies->first();

        $response->assertRedirect(route('radiology.index'));
        $response->assertSessionHas('radiology.id', $radiology->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $radiology = Radiology::factory()->create();

        $response = $this->get(route('radiology.show', $radiology));

        $response->assertOk();
        $response->assertViewIs('radiology.show');
        $response->assertViewHas('radiology');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $radiology = Radiology::factory()->create();

        $response = $this->get(route('radiology.edit', $radiology));

        $response->assertOk();
        $response->assertViewIs('radiology.edit');
        $response->assertViewHas('radiology');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RadiologyController::class,
            'update',
            \App\Http\Requests\RadiologyUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $radiology = Radiology::factory()->create();
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('radiology.update', $radiology), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $radiology->refresh();

        $response->assertRedirect(route('radiology.index'));
        $response->assertSessionHas('radiology.id', $radiology->id);

        $this->assertEquals($status, $radiology->status);
        $this->assertEquals($created_by->id, $radiology->created_by_id);
        $this->assertEquals($updated_by->id, $radiology->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $radiology = Radiology::factory()->create();

        $response = $this->delete(route('radiology.destroy', $radiology));

        $response->assertRedirect(route('radiology.index'));

        $this->assertModelMissing($radiology);
    }
}
