<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\PharmacyInvoice;
use App\Models\PharmacyInvoiceDetail;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PharmacyInvoiceDetailController
 */
class PharmacyInvoiceDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $pharmacyInvoiceDetails = PharmacyInvoiceDetail::factory()->count(3)->create();

        $response = $this->get(route('pharmacy-invoice-detail.index'));

        $response->assertOk();
        $response->assertViewIs('pharmacyInvoiceDetail.index');
        $response->assertViewHas('pharmacyInvoiceDetails');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('pharmacy-invoice-detail.create'));

        $response->assertOk();
        $response->assertViewIs('pharmacyInvoiceDetail.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PharmacyInvoiceDetailController::class,
            'store',
            \App\Http\Requests\PharmacyInvoiceDetailStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $item_amount = $this->faker->numberBetween(-10000, 10000);
        $item_total_amount = $this->faker->numberBetween(-10000, 10000);
        $pharmacy_invoice = PharmacyInvoice::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('pharmacy-invoice-detail.store'), [
            'item_amount' => $item_amount,
            'item_total_amount' => $item_total_amount,
            'pharmacy_invoice_id' => $pharmacy_invoice->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $pharmacyInvoiceDetails = PharmacyInvoiceDetail::query()
            ->where('item_amount', $item_amount)
            ->where('item_total_amount', $item_total_amount)
            ->where('pharmacy_invoice_id', $pharmacy_invoice->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $pharmacyInvoiceDetails);
        $pharmacyInvoiceDetail = $pharmacyInvoiceDetails->first();

        $response->assertRedirect(route('pharmacyInvoiceDetail.index'));
        $response->assertSessionHas('pharmacyInvoiceDetail.id', $pharmacyInvoiceDetail->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $pharmacyInvoiceDetail = PharmacyInvoiceDetail::factory()->create();

        $response = $this->get(route('pharmacy-invoice-detail.show', $pharmacyInvoiceDetail));

        $response->assertOk();
        $response->assertViewIs('pharmacyInvoiceDetail.show');
        $response->assertViewHas('pharmacyInvoiceDetail');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $pharmacyInvoiceDetail = PharmacyInvoiceDetail::factory()->create();

        $response = $this->get(route('pharmacy-invoice-detail.edit', $pharmacyInvoiceDetail));

        $response->assertOk();
        $response->assertViewIs('pharmacyInvoiceDetail.edit');
        $response->assertViewHas('pharmacyInvoiceDetail');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PharmacyInvoiceDetailController::class,
            'update',
            \App\Http\Requests\PharmacyInvoiceDetailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $pharmacyInvoiceDetail = PharmacyInvoiceDetail::factory()->create();
        $item_amount = $this->faker->numberBetween(-10000, 10000);
        $item_total_amount = $this->faker->numberBetween(-10000, 10000);
        $pharmacy_invoice = PharmacyInvoice::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('pharmacy-invoice-detail.update', $pharmacyInvoiceDetail), [
            'item_amount' => $item_amount,
            'item_total_amount' => $item_total_amount,
            'pharmacy_invoice_id' => $pharmacy_invoice->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $pharmacyInvoiceDetail->refresh();

        $response->assertRedirect(route('pharmacyInvoiceDetail.index'));
        $response->assertSessionHas('pharmacyInvoiceDetail.id', $pharmacyInvoiceDetail->id);

        $this->assertEquals($item_amount, $pharmacyInvoiceDetail->item_amount);
        $this->assertEquals($item_total_amount, $pharmacyInvoiceDetail->item_total_amount);
        $this->assertEquals($pharmacy_invoice->id, $pharmacyInvoiceDetail->pharmacy_invoice_id);
        $this->assertEquals($created_by->id, $pharmacyInvoiceDetail->created_by_id);
        $this->assertEquals($updated_by->id, $pharmacyInvoiceDetail->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $pharmacyInvoiceDetail = PharmacyInvoiceDetail::factory()->create();

        $response = $this->delete(route('pharmacy-invoice-detail.destroy', $pharmacyInvoiceDetail));

        $response->assertRedirect(route('pharmacyInvoiceDetail.index'));

        $this->assertModelMissing($pharmacyInvoiceDetail);
    }
}
