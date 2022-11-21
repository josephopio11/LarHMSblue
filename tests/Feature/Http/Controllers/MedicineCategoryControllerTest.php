<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\MedicineCategory;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MedicineCategoryController
 */
class MedicineCategoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $medicineCategories = MedicineCategory::factory()->count(3)->create();

        $response = $this->get(route('medicine-category.index'));

        $response->assertOk();
        $response->assertViewIs('medicineCategory.index');
        $response->assertViewHas('medicineCategories');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('medicine-category.create'));

        $response->assertOk();
        $response->assertViewIs('medicineCategory.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MedicineCategoryController::class,
            'store',
            \App\Http\Requests\MedicineCategoryStoreRequest::class
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

        $response = $this->post(route('medicine-category.store'), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $medicineCategories = MedicineCategory::query()
            ->where('status', $status)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $medicineCategories);
        $medicineCategory = $medicineCategories->first();

        $response->assertRedirect(route('medicineCategory.index'));
        $response->assertSessionHas('medicineCategory.id', $medicineCategory->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $medicineCategory = MedicineCategory::factory()->create();

        $response = $this->get(route('medicine-category.show', $medicineCategory));

        $response->assertOk();
        $response->assertViewIs('medicineCategory.show');
        $response->assertViewHas('medicineCategory');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $medicineCategory = MedicineCategory::factory()->create();

        $response = $this->get(route('medicine-category.edit', $medicineCategory));

        $response->assertOk();
        $response->assertViewIs('medicineCategory.edit');
        $response->assertViewHas('medicineCategory');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MedicineCategoryController::class,
            'update',
            \App\Http\Requests\MedicineCategoryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $medicineCategory = MedicineCategory::factory()->create();
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('medicine-category.update', $medicineCategory), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $medicineCategory->refresh();

        $response->assertRedirect(route('medicineCategory.index'));
        $response->assertSessionHas('medicineCategory.id', $medicineCategory->id);

        $this->assertEquals($status, $medicineCategory->status);
        $this->assertEquals($created_by->id, $medicineCategory->created_by_id);
        $this->assertEquals($updated_by->id, $medicineCategory->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $medicineCategory = MedicineCategory::factory()->create();

        $response = $this->delete(route('medicine-category.destroy', $medicineCategory));

        $response->assertRedirect(route('medicineCategory.index'));

        $this->assertModelMissing($medicineCategory);
    }
}
