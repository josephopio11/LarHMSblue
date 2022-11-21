<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\MedicineCategory;
use App\Models\MedicineType;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PurchaseController
 */
class PurchaseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $purchases = Purchase::factory()->count(3)->create();

        $response = $this->get(route('purchase.index'));

        $response->assertOk();
        $response->assertViewIs('purchase.index');
        $response->assertViewHas('purchases');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('purchase.create'));

        $response->assertOk();
        $response->assertViewIs('purchase.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PurchaseController::class,
            'store',
            \App\Http\Requests\PurchaseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $type = $this->faker->word;
        $quantity = $this->faker->numberBetween(-10000, 10000);
        $price = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $medicine_type = MedicineType::factory()->create();
        $medicine_category = MedicineCategory::factory()->create();
        $supplier = Supplier::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('purchase.store'), [
            'type' => $type,
            'quantity' => $quantity,
            'price' => $price,
            'status' => $status,
            'medicine_type_id' => $medicine_type->id,
            'medicine_category_id' => $medicine_category->id,
            'supplier_id' => $supplier->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $purchases = Purchase::query()
            ->where('type', $type)
            ->where('quantity', $quantity)
            ->where('price', $price)
            ->where('status', $status)
            ->where('medicine_type_id', $medicine_type->id)
            ->where('medicine_category_id', $medicine_category->id)
            ->where('supplier_id', $supplier->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $purchases);
        $purchase = $purchases->first();

        $response->assertRedirect(route('purchase.index'));
        $response->assertSessionHas('purchase.id', $purchase->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $purchase = Purchase::factory()->create();

        $response = $this->get(route('purchase.show', $purchase));

        $response->assertOk();
        $response->assertViewIs('purchase.show');
        $response->assertViewHas('purchase');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $purchase = Purchase::factory()->create();

        $response = $this->get(route('purchase.edit', $purchase));

        $response->assertOk();
        $response->assertViewIs('purchase.edit');
        $response->assertViewHas('purchase');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PurchaseController::class,
            'update',
            \App\Http\Requests\PurchaseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $purchase = Purchase::factory()->create();
        $type = $this->faker->word;
        $quantity = $this->faker->numberBetween(-10000, 10000);
        $price = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $medicine_type = MedicineType::factory()->create();
        $medicine_category = MedicineCategory::factory()->create();
        $supplier = Supplier::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('purchase.update', $purchase), [
            'type' => $type,
            'quantity' => $quantity,
            'price' => $price,
            'status' => $status,
            'medicine_type_id' => $medicine_type->id,
            'medicine_category_id' => $medicine_category->id,
            'supplier_id' => $supplier->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $purchase->refresh();

        $response->assertRedirect(route('purchase.index'));
        $response->assertSessionHas('purchase.id', $purchase->id);

        $this->assertEquals($type, $purchase->type);
        $this->assertEquals($quantity, $purchase->quantity);
        $this->assertEquals($price, $purchase->price);
        $this->assertEquals($status, $purchase->status);
        $this->assertEquals($medicine_type->id, $purchase->medicine_type_id);
        $this->assertEquals($medicine_category->id, $purchase->medicine_category_id);
        $this->assertEquals($supplier->id, $purchase->supplier_id);
        $this->assertEquals($created_by->id, $purchase->created_by_id);
        $this->assertEquals($updated_by->id, $purchase->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $purchase = Purchase::factory()->create();

        $response = $this->delete(route('purchase.destroy', $purchase));

        $response->assertRedirect(route('purchase.index'));

        $this->assertModelMissing($purchase);
    }
}
