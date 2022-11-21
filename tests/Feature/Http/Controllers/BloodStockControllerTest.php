<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\BloodBank;
use App\Models\BloodStock;
use App\Models\CreatedBy;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BloodStockController
 */
class BloodStockControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $bloodStocks = BloodStock::factory()->count(3)->create();

        $response = $this->get(route('blood-stock.index'));

        $response->assertOk();
        $response->assertViewIs('bloodStock.index');
        $response->assertViewHas('bloodStocks');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('blood-stock.create'));

        $response->assertOk();
        $response->assertViewIs('bloodStock.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BloodStockController::class,
            'store',
            \App\Http\Requests\BloodStockStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $blood_bank = BloodBank::factory()->create();
        $unit = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('blood-stock.store'), [
            'blood_bank_id' => $blood_bank->id,
            'unit' => $unit,
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $bloodStocks = BloodStock::query()
            ->where('blood_bank_id', $blood_bank->id)
            ->where('unit', $unit)
            ->where('status', $status)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $bloodStocks);
        $bloodStock = $bloodStocks->first();

        $response->assertRedirect(route('bloodStock.index'));
        $response->assertSessionHas('bloodStock.id', $bloodStock->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $bloodStock = BloodStock::factory()->create();

        $response = $this->get(route('blood-stock.show', $bloodStock));

        $response->assertOk();
        $response->assertViewIs('bloodStock.show');
        $response->assertViewHas('bloodStock');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $bloodStock = BloodStock::factory()->create();

        $response = $this->get(route('blood-stock.edit', $bloodStock));

        $response->assertOk();
        $response->assertViewIs('bloodStock.edit');
        $response->assertViewHas('bloodStock');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BloodStockController::class,
            'update',
            \App\Http\Requests\BloodStockUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $bloodStock = BloodStock::factory()->create();
        $blood_bank = BloodBank::factory()->create();
        $unit = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('blood-stock.update', $bloodStock), [
            'blood_bank_id' => $blood_bank->id,
            'unit' => $unit,
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $bloodStock->refresh();

        $response->assertRedirect(route('bloodStock.index'));
        $response->assertSessionHas('bloodStock.id', $bloodStock->id);

        $this->assertEquals($blood_bank->id, $bloodStock->blood_bank_id);
        $this->assertEquals($unit, $bloodStock->unit);
        $this->assertEquals($status, $bloodStock->status);
        $this->assertEquals($created_by->id, $bloodStock->created_by_id);
        $this->assertEquals($updated_by->id, $bloodStock->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $bloodStock = BloodStock::factory()->create();

        $response = $this->delete(route('blood-stock.destroy', $bloodStock));

        $response->assertRedirect(route('bloodStock.index'));

        $this->assertModelMissing($bloodStock);
    }
}
