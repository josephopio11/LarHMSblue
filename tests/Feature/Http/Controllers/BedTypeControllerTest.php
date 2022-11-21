<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\BedType;
use App\Models\CreatedBy;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BedTypeController
 */
class BedTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $bedTypes = BedType::factory()->count(3)->create();

        $response = $this->get(route('bed-type.index'));

        $response->assertOk();
        $response->assertViewIs('bedType.index');
        $response->assertViewHas('bedTypes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('bed-type.create'));

        $response->assertOk();
        $response->assertViewIs('bedType.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BedTypeController::class,
            'store',
            \App\Http\Requests\BedTypeStoreRequest::class
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

        $response = $this->post(route('bed-type.store'), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $bedTypes = BedType::query()
            ->where('status', $status)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $bedTypes);
        $bedType = $bedTypes->first();

        $response->assertRedirect(route('bedType.index'));
        $response->assertSessionHas('bedType.id', $bedType->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $bedType = BedType::factory()->create();

        $response = $this->get(route('bed-type.show', $bedType));

        $response->assertOk();
        $response->assertViewIs('bedType.show');
        $response->assertViewHas('bedType');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $bedType = BedType::factory()->create();

        $response = $this->get(route('bed-type.edit', $bedType));

        $response->assertOk();
        $response->assertViewIs('bedType.edit');
        $response->assertViewHas('bedType');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BedTypeController::class,
            'update',
            \App\Http\Requests\BedTypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $bedType = BedType::factory()->create();
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('bed-type.update', $bedType), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $bedType->refresh();

        $response->assertRedirect(route('bedType.index'));
        $response->assertSessionHas('bedType.id', $bedType->id);

        $this->assertEquals($status, $bedType->status);
        $this->assertEquals($created_by->id, $bedType->created_by_id);
        $this->assertEquals($updated_by->id, $bedType->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $bedType = BedType::factory()->create();

        $response = $this->delete(route('bed-type.destroy', $bedType));

        $response->assertRedirect(route('bedType.index'));

        $this->assertModelMissing($bedType);
    }
}
