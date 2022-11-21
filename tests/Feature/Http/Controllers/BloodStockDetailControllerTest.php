<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\BloodStock;
use App\Models\BloodStockDetail;
use App\Models\CreatedBy;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BloodStockDetailController
 */
class BloodStockDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $bloodStockDetails = BloodStockDetail::factory()->count(3)->create();

        $response = $this->get(route('blood-stock-detail.index'));

        $response->assertOk();
        $response->assertViewIs('bloodStockDetail.index');
        $response->assertViewHas('bloodStockDetails');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('blood-stock-detail.create'));

        $response->assertOk();
        $response->assertViewIs('bloodStockDetail.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BloodStockDetailController::class,
            'store',
            \App\Http\Requests\BloodStockDetailStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $unit = $this->faker->numberBetween(-10000, 10000);
        $total = $this->faker->numberBetween(-10000, 10000);
        $balance = $this->faker->numberBetween(-10000, 10000);
        $blood_stock = BloodStock::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('blood-stock-detail.store'), [
            'unit' => $unit,
            'total' => $total,
            'balance' => $balance,
            'blood_stock_id' => $blood_stock->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $bloodStockDetails = BloodStockDetail::query()
            ->where('unit', $unit)
            ->where('total', $total)
            ->where('balance', $balance)
            ->where('blood_stock_id', $blood_stock->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $bloodStockDetails);
        $bloodStockDetail = $bloodStockDetails->first();

        $response->assertRedirect(route('bloodStockDetail.index'));
        $response->assertSessionHas('bloodStockDetail.id', $bloodStockDetail->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $bloodStockDetail = BloodStockDetail::factory()->create();

        $response = $this->get(route('blood-stock-detail.show', $bloodStockDetail));

        $response->assertOk();
        $response->assertViewIs('bloodStockDetail.show');
        $response->assertViewHas('bloodStockDetail');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $bloodStockDetail = BloodStockDetail::factory()->create();

        $response = $this->get(route('blood-stock-detail.edit', $bloodStockDetail));

        $response->assertOk();
        $response->assertViewIs('bloodStockDetail.edit');
        $response->assertViewHas('bloodStockDetail');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BloodStockDetailController::class,
            'update',
            \App\Http\Requests\BloodStockDetailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $bloodStockDetail = BloodStockDetail::factory()->create();
        $unit = $this->faker->numberBetween(-10000, 10000);
        $total = $this->faker->numberBetween(-10000, 10000);
        $balance = $this->faker->numberBetween(-10000, 10000);
        $blood_stock = BloodStock::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('blood-stock-detail.update', $bloodStockDetail), [
            'unit' => $unit,
            'total' => $total,
            'balance' => $balance,
            'blood_stock_id' => $blood_stock->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $bloodStockDetail->refresh();

        $response->assertRedirect(route('bloodStockDetail.index'));
        $response->assertSessionHas('bloodStockDetail.id', $bloodStockDetail->id);

        $this->assertEquals($unit, $bloodStockDetail->unit);
        $this->assertEquals($total, $bloodStockDetail->total);
        $this->assertEquals($balance, $bloodStockDetail->balance);
        $this->assertEquals($blood_stock->id, $bloodStockDetail->blood_stock_id);
        $this->assertEquals($created_by->id, $bloodStockDetail->created_by_id);
        $this->assertEquals($updated_by->id, $bloodStockDetail->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $bloodStockDetail = BloodStockDetail::factory()->create();

        $response = $this->delete(route('blood-stock-detail.destroy', $bloodStockDetail));

        $response->assertRedirect(route('bloodStockDetail.index'));

        $this->assertModelMissing($bloodStockDetail);
    }
}
