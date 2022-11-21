<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\BillingInvoice;
use App\Models\BillingInvoiceDetail;
use App\Models\CreatedBy;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BillingInvoiceDetailController
 */
class BillingInvoiceDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $billingInvoiceDetails = BillingInvoiceDetail::factory()->count(3)->create();

        $response = $this->get(route('billing-invoice-detail.index'));

        $response->assertOk();
        $response->assertViewIs('billingInvoiceDetail.index');
        $response->assertViewHas('billingInvoiceDetails');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('billing-invoice-detail.create'));

        $response->assertOk();
        $response->assertViewIs('billingInvoiceDetail.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BillingInvoiceDetailController::class,
            'store',
            \App\Http\Requests\BillingInvoiceDetailStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $item_amount = $this->faker->numberBetween(-10000, 10000);
        $item_total_amount = $this->faker->numberBetween(-10000, 10000);
        $billing_invoice = BillingInvoice::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('billing-invoice-detail.store'), [
            'item_amount' => $item_amount,
            'item_total_amount' => $item_total_amount,
            'billing_invoice_id' => $billing_invoice->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $billingInvoiceDetails = BillingInvoiceDetail::query()
            ->where('item_amount', $item_amount)
            ->where('item_total_amount', $item_total_amount)
            ->where('billing_invoice_id', $billing_invoice->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $billingInvoiceDetails);
        $billingInvoiceDetail = $billingInvoiceDetails->first();

        $response->assertRedirect(route('billingInvoiceDetail.index'));
        $response->assertSessionHas('billingInvoiceDetail.id', $billingInvoiceDetail->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $billingInvoiceDetail = BillingInvoiceDetail::factory()->create();

        $response = $this->get(route('billing-invoice-detail.show', $billingInvoiceDetail));

        $response->assertOk();
        $response->assertViewIs('billingInvoiceDetail.show');
        $response->assertViewHas('billingInvoiceDetail');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $billingInvoiceDetail = BillingInvoiceDetail::factory()->create();

        $response = $this->get(route('billing-invoice-detail.edit', $billingInvoiceDetail));

        $response->assertOk();
        $response->assertViewIs('billingInvoiceDetail.edit');
        $response->assertViewHas('billingInvoiceDetail');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BillingInvoiceDetailController::class,
            'update',
            \App\Http\Requests\BillingInvoiceDetailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $billingInvoiceDetail = BillingInvoiceDetail::factory()->create();
        $item_amount = $this->faker->numberBetween(-10000, 10000);
        $item_total_amount = $this->faker->numberBetween(-10000, 10000);
        $billing_invoice = BillingInvoice::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('billing-invoice-detail.update', $billingInvoiceDetail), [
            'item_amount' => $item_amount,
            'item_total_amount' => $item_total_amount,
            'billing_invoice_id' => $billing_invoice->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $billingInvoiceDetail->refresh();

        $response->assertRedirect(route('billingInvoiceDetail.index'));
        $response->assertSessionHas('billingInvoiceDetail.id', $billingInvoiceDetail->id);

        $this->assertEquals($item_amount, $billingInvoiceDetail->item_amount);
        $this->assertEquals($item_total_amount, $billingInvoiceDetail->item_total_amount);
        $this->assertEquals($billing_invoice->id, $billingInvoiceDetail->billing_invoice_id);
        $this->assertEquals($created_by->id, $billingInvoiceDetail->created_by_id);
        $this->assertEquals($updated_by->id, $billingInvoiceDetail->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $billingInvoiceDetail = BillingInvoiceDetail::factory()->create();

        $response = $this->delete(route('billing-invoice-detail.destroy', $billingInvoiceDetail));

        $response->assertRedirect(route('billingInvoiceDetail.index'));

        $this->assertModelMissing($billingInvoiceDetail);
    }
}
