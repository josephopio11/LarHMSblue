<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Bed;
use App\Models\BedType;
use App\Models\CreatedBy;
use App\Models\Room;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BedController
 */
class BedControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $beds = Bed::factory()->count(3)->create();

        $response = $this->get(route('bed.index'));

        $response->assertOk();
        $response->assertViewIs('bed.index');
        $response->assertViewHas('beds');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('bed.create'));

        $response->assertOk();
        $response->assertViewIs('bed.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BedController::class,
            'store',
            \App\Http\Requests\BedStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $price = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $room = Room::factory()->create();
        $bed_type = BedType::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('bed.store'), [
            'price' => $price,
            'status' => $status,
            'room_id' => $room->id,
            'bed_type_id' => $bed_type->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $beds = Bed::query()
            ->where('price', $price)
            ->where('status', $status)
            ->where('room_id', $room->id)
            ->where('bed_type_id', $bed_type->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $beds);
        $bed = $beds->first();

        $response->assertRedirect(route('bed.index'));
        $response->assertSessionHas('bed.id', $bed->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $bed = Bed::factory()->create();

        $response = $this->get(route('bed.show', $bed));

        $response->assertOk();
        $response->assertViewIs('bed.show');
        $response->assertViewHas('bed');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $bed = Bed::factory()->create();

        $response = $this->get(route('bed.edit', $bed));

        $response->assertOk();
        $response->assertViewIs('bed.edit');
        $response->assertViewHas('bed');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BedController::class,
            'update',
            \App\Http\Requests\BedUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $bed = Bed::factory()->create();
        $price = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $room = Room::factory()->create();
        $bed_type = BedType::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('bed.update', $bed), [
            'price' => $price,
            'status' => $status,
            'room_id' => $room->id,
            'bed_type_id' => $bed_type->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $bed->refresh();

        $response->assertRedirect(route('bed.index'));
        $response->assertSessionHas('bed.id', $bed->id);

        $this->assertEquals($price, $bed->price);
        $this->assertEquals($status, $bed->status);
        $this->assertEquals($room->id, $bed->room_id);
        $this->assertEquals($bed_type->id, $bed->bed_type_id);
        $this->assertEquals($created_by->id, $bed->created_by_id);
        $this->assertEquals($updated_by->id, $bed->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $bed = Bed::factory()->create();

        $response = $this->delete(route('bed.destroy', $bed));

        $response->assertRedirect(route('bed.index'));

        $this->assertModelMissing($bed);
    }
}
