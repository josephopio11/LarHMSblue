<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\UpdatedBy;
use App\Models\Ward;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\WardController
 */
class WardControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $wards = Ward::factory()->count(3)->create();

        $response = $this->get(route('ward.index'));

        $response->assertOk();
        $response->assertViewIs('ward.index');
        $response->assertViewHas('wards');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('ward.create'));

        $response->assertOk();
        $response->assertViewIs('ward.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WardController::class,
            'store',
            \App\Http\Requests\WardStoreRequest::class
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

        $response = $this->post(route('ward.store'), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $wards = Ward::query()
            ->where('status', $status)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $wards);
        $ward = $wards->first();

        $response->assertRedirect(route('ward.index'));
        $response->assertSessionHas('ward.id', $ward->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $ward = Ward::factory()->create();

        $response = $this->get(route('ward.show', $ward));

        $response->assertOk();
        $response->assertViewIs('ward.show');
        $response->assertViewHas('ward');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $ward = Ward::factory()->create();

        $response = $this->get(route('ward.edit', $ward));

        $response->assertOk();
        $response->assertViewIs('ward.edit');
        $response->assertViewHas('ward');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WardController::class,
            'update',
            \App\Http\Requests\WardUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $ward = Ward::factory()->create();
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('ward.update', $ward), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $ward->refresh();

        $response->assertRedirect(route('ward.index'));
        $response->assertSessionHas('ward.id', $ward->id);

        $this->assertEquals($status, $ward->status);
        $this->assertEquals($created_by->id, $ward->created_by_id);
        $this->assertEquals($updated_by->id, $ward->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $ward = Ward::factory()->create();

        $response = $this->delete(route('ward.destroy', $ward));

        $response->assertRedirect(route('ward.index'));

        $this->assertModelMissing($ward);
    }
}
