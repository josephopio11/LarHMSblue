<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\RoomType;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RoomTypeController
 */
class RoomTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $roomTypes = RoomType::factory()->count(3)->create();

        $response = $this->get(route('room-type.index'));

        $response->assertOk();
        $response->assertViewIs('roomType.index');
        $response->assertViewHas('roomTypes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('room-type.create'));

        $response->assertOk();
        $response->assertViewIs('roomType.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RoomTypeController::class,
            'store',
            \App\Http\Requests\RoomTypeStoreRequest::class
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

        $response = $this->post(route('room-type.store'), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $roomTypes = RoomType::query()
            ->where('status', $status)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $roomTypes);
        $roomType = $roomTypes->first();

        $response->assertRedirect(route('roomType.index'));
        $response->assertSessionHas('roomType.id', $roomType->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $roomType = RoomType::factory()->create();

        $response = $this->get(route('room-type.show', $roomType));

        $response->assertOk();
        $response->assertViewIs('roomType.show');
        $response->assertViewHas('roomType');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $roomType = RoomType::factory()->create();

        $response = $this->get(route('room-type.edit', $roomType));

        $response->assertOk();
        $response->assertViewIs('roomType.edit');
        $response->assertViewHas('roomType');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RoomTypeController::class,
            'update',
            \App\Http\Requests\RoomTypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $roomType = RoomType::factory()->create();
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('room-type.update', $roomType), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $roomType->refresh();

        $response->assertRedirect(route('roomType.index'));
        $response->assertSessionHas('roomType.id', $roomType->id);

        $this->assertEquals($status, $roomType->status);
        $this->assertEquals($created_by->id, $roomType->created_by_id);
        $this->assertEquals($updated_by->id, $roomType->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $roomType = RoomType::factory()->create();

        $response = $this->delete(route('room-type.destroy', $roomType));

        $response->assertRedirect(route('roomType.index'));

        $this->assertModelMissing($roomType);
    }
}
