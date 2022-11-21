<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\MedicineType;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MedicineTypeController
 */
class MedicineTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $medicineTypes = MedicineType::factory()->count(3)->create();

        $response = $this->get(route('medicine-type.index'));

        $response->assertOk();
        $response->assertViewIs('medicineType.index');
        $response->assertViewHas('medicineTypes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('medicine-type.create'));

        $response->assertOk();
        $response->assertViewIs('medicineType.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MedicineTypeController::class,
            'store',
            \App\Http\Requests\MedicineTypeStoreRequest::class
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

        $response = $this->post(route('medicine-type.store'), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $medicineTypes = MedicineType::query()
            ->where('status', $status)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $medicineTypes);
        $medicineType = $medicineTypes->first();

        $response->assertRedirect(route('medicineType.index'));
        $response->assertSessionHas('medicineType.id', $medicineType->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $medicineType = MedicineType::factory()->create();

        $response = $this->get(route('medicine-type.show', $medicineType));

        $response->assertOk();
        $response->assertViewIs('medicineType.show');
        $response->assertViewHas('medicineType');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $medicineType = MedicineType::factory()->create();

        $response = $this->get(route('medicine-type.edit', $medicineType));

        $response->assertOk();
        $response->assertViewIs('medicineType.edit');
        $response->assertViewHas('medicineType');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MedicineTypeController::class,
            'update',
            \App\Http\Requests\MedicineTypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $medicineType = MedicineType::factory()->create();
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('medicine-type.update', $medicineType), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $medicineType->refresh();

        $response->assertRedirect(route('medicineType.index'));
        $response->assertSessionHas('medicineType.id', $medicineType->id);

        $this->assertEquals($status, $medicineType->status);
        $this->assertEquals($created_by->id, $medicineType->created_by_id);
        $this->assertEquals($updated_by->id, $medicineType->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $medicineType = MedicineType::factory()->create();

        $response = $this->delete(route('medicine-type.destroy', $medicineType));

        $response->assertRedirect(route('medicineType.index'));

        $this->assertModelMissing($medicineType);
    }
}
