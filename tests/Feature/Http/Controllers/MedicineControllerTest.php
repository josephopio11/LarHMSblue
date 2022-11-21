<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Medicine;
use App\Models\Purchase;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MedicineController
 */
class MedicineControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $medicines = Medicine::factory()->count(3)->create();

        $response = $this->get(route('medicine.index'));

        $response->assertOk();
        $response->assertViewIs('medicine.index');
        $response->assertViewHas('medicines');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('medicine.create'));

        $response->assertOk();
        $response->assertViewIs('medicine.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MedicineController::class,
            'store',
            \App\Http\Requests\MedicineStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $medicine_price = $this->faker->numberBetween(-10000, 10000);
        $medicine_profit = $this->faker->numberBetween(-10000, 10000);
        $available_quantity = $this->faker->numberBetween(-10000, 10000);
        $alert_quantity = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $purchase = Purchase::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('medicine.store'), [
            'medicine_price' => $medicine_price,
            'medicine_profit' => $medicine_profit,
            'available_quantity' => $available_quantity,
            'alert_quantity' => $alert_quantity,
            'status' => $status,
            'purchase_id' => $purchase->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $medicines = Medicine::query()
            ->where('medicine_price', $medicine_price)
            ->where('medicine_profit', $medicine_profit)
            ->where('available_quantity', $available_quantity)
            ->where('alert_quantity', $alert_quantity)
            ->where('status', $status)
            ->where('purchase_id', $purchase->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $medicines);
        $medicine = $medicines->first();

        $response->assertRedirect(route('medicine.index'));
        $response->assertSessionHas('medicine.id', $medicine->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $medicine = Medicine::factory()->create();

        $response = $this->get(route('medicine.show', $medicine));

        $response->assertOk();
        $response->assertViewIs('medicine.show');
        $response->assertViewHas('medicine');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $medicine = Medicine::factory()->create();

        $response = $this->get(route('medicine.edit', $medicine));

        $response->assertOk();
        $response->assertViewIs('medicine.edit');
        $response->assertViewHas('medicine');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MedicineController::class,
            'update',
            \App\Http\Requests\MedicineUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $medicine = Medicine::factory()->create();
        $medicine_price = $this->faker->numberBetween(-10000, 10000);
        $medicine_profit = $this->faker->numberBetween(-10000, 10000);
        $available_quantity = $this->faker->numberBetween(-10000, 10000);
        $alert_quantity = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $purchase = Purchase::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('medicine.update', $medicine), [
            'medicine_price' => $medicine_price,
            'medicine_profit' => $medicine_profit,
            'available_quantity' => $available_quantity,
            'alert_quantity' => $alert_quantity,
            'status' => $status,
            'purchase_id' => $purchase->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $medicine->refresh();

        $response->assertRedirect(route('medicine.index'));
        $response->assertSessionHas('medicine.id', $medicine->id);

        $this->assertEquals($medicine_price, $medicine->medicine_price);
        $this->assertEquals($medicine_profit, $medicine->medicine_profit);
        $this->assertEquals($available_quantity, $medicine->available_quantity);
        $this->assertEquals($alert_quantity, $medicine->alert_quantity);
        $this->assertEquals($status, $medicine->status);
        $this->assertEquals($purchase->id, $medicine->purchase_id);
        $this->assertEquals($created_by->id, $medicine->created_by_id);
        $this->assertEquals($updated_by->id, $medicine->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $medicine = Medicine::factory()->create();

        $response = $this->delete(route('medicine.destroy', $medicine));

        $response->assertRedirect(route('medicine.index'));

        $this->assertModelMissing($medicine);
    }
}
