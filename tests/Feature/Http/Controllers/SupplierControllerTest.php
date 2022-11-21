<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Supplier;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SupplierController
 */
class SupplierControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $suppliers = Supplier::factory()->count(3)->create();

        $response = $this->get(route('supplier.index'));

        $response->assertOk();
        $response->assertViewIs('supplier.index');
        $response->assertViewHas('suppliers');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('supplier.create'));

        $response->assertOk();
        $response->assertViewIs('supplier.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SupplierController::class,
            'store',
            \App\Http\Requests\SupplierStoreRequest::class
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

        $response = $this->post(route('supplier.store'), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $suppliers = Supplier::query()
            ->where('status', $status)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $suppliers);
        $supplier = $suppliers->first();

        $response->assertRedirect(route('supplier.index'));
        $response->assertSessionHas('supplier.id', $supplier->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $supplier = Supplier::factory()->create();

        $response = $this->get(route('supplier.show', $supplier));

        $response->assertOk();
        $response->assertViewIs('supplier.show');
        $response->assertViewHas('supplier');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $supplier = Supplier::factory()->create();

        $response = $this->get(route('supplier.edit', $supplier));

        $response->assertOk();
        $response->assertViewIs('supplier.edit');
        $response->assertViewHas('supplier');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SupplierController::class,
            'update',
            \App\Http\Requests\SupplierUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $supplier = Supplier::factory()->create();
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('supplier.update', $supplier), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $supplier->refresh();

        $response->assertRedirect(route('supplier.index'));
        $response->assertSessionHas('supplier.id', $supplier->id);

        $this->assertEquals($status, $supplier->status);
        $this->assertEquals($created_by->id, $supplier->created_by_id);
        $this->assertEquals($updated_by->id, $supplier->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $supplier = Supplier::factory()->create();

        $response = $this->delete(route('supplier.destroy', $supplier));

        $response->assertRedirect(route('supplier.index'));

        $this->assertModelMissing($supplier);
    }
}
