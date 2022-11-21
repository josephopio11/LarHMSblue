<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\UpdatedBy;
use App\Models\Ward;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RoomController
 */
class RoomControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $rooms = Room::factory()->count(3)->create();

        $response = $this->get(route('room.index'));

        $response->assertOk();
        $response->assertViewIs('room.index');
        $response->assertViewHas('rooms');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('room.create'));

        $response->assertOk();
        $response->assertViewIs('room.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RoomController::class,
            'store',
            \App\Http\Requests\RoomStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $price = $this->faker->numberBetween(-10000, 10000);
        $capacity = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $ward = Ward::factory()->create();
        $room_type = RoomType::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('room.store'), [
            'price' => $price,
            'capacity' => $capacity,
            'status' => $status,
            'ward_id' => $ward->id,
            'room_type_id' => $room_type->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $rooms = Room::query()
            ->where('price', $price)
            ->where('capacity', $capacity)
            ->where('status', $status)
            ->where('ward_id', $ward->id)
            ->where('room_type_id', $room_type->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $rooms);
        $room = $rooms->first();

        $response->assertRedirect(route('room.index'));
        $response->assertSessionHas('room.id', $room->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $room = Room::factory()->create();

        $response = $this->get(route('room.show', $room));

        $response->assertOk();
        $response->assertViewIs('room.show');
        $response->assertViewHas('room');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $room = Room::factory()->create();

        $response = $this->get(route('room.edit', $room));

        $response->assertOk();
        $response->assertViewIs('room.edit');
        $response->assertViewHas('room');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RoomController::class,
            'update',
            \App\Http\Requests\RoomUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $room = Room::factory()->create();
        $price = $this->faker->numberBetween(-10000, 10000);
        $capacity = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $ward = Ward::factory()->create();
        $room_type = RoomType::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('room.update', $room), [
            'price' => $price,
            'capacity' => $capacity,
            'status' => $status,
            'ward_id' => $ward->id,
            'room_type_id' => $room_type->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $room->refresh();

        $response->assertRedirect(route('room.index'));
        $response->assertSessionHas('room.id', $room->id);

        $this->assertEquals($price, $room->price);
        $this->assertEquals($capacity, $room->capacity);
        $this->assertEquals($status, $room->status);
        $this->assertEquals($ward->id, $room->ward_id);
        $this->assertEquals($room_type->id, $room->room_type_id);
        $this->assertEquals($created_by->id, $room->created_by_id);
        $this->assertEquals($updated_by->id, $room->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $room = Room::factory()->create();

        $response = $this->delete(route('room.destroy', $room));

        $response->assertRedirect(route('room.index'));

        $this->assertModelMissing($room);
    }
}
