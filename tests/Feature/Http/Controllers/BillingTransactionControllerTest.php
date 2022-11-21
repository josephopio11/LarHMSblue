<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\BillingInvoice;
use App\Models\BillingTransaction;
use App\Models\CreatedBy;
use App\Models\PatientVisit;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BillingTransactionController
 */
class BillingTransactionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $billingTransactions = BillingTransaction::factory()->count(3)->create();

        $response = $this->get(route('billing-transaction.index'));

        $response->assertOk();
        $response->assertViewIs('billingTransaction.index');
        $response->assertViewHas('billingTransactions');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('billing-transaction.create'));

        $response->assertOk();
        $response->assertViewIs('billingTransaction.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BillingTransactionController::class,
            'store',
            \App\Http\Requests\BillingTransactionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $payment_amount = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $patient_visit = PatientVisit::factory()->create();
        $billing_invoice = BillingInvoice::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('billing-transaction.store'), [
            'payment_amount' => $payment_amount,
            'status' => $status,
            'patient_visit_id' => $patient_visit->id,
            'billing_invoice_id' => $billing_invoice->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $billingTransactions = BillingTransaction::query()
            ->where('payment_amount', $payment_amount)
            ->where('status', $status)
            ->where('patient_visit_id', $patient_visit->id)
            ->where('billing_invoice_id', $billing_invoice->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $billingTransactions);
        $billingTransaction = $billingTransactions->first();

        $response->assertRedirect(route('billingTransaction.index'));
        $response->assertSessionHas('billingTransaction.id', $billingTransaction->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $billingTransaction = BillingTransaction::factory()->create();

        $response = $this->get(route('billing-transaction.show', $billingTransaction));

        $response->assertOk();
        $response->assertViewIs('billingTransaction.show');
        $response->assertViewHas('billingTransaction');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $billingTransaction = BillingTransaction::factory()->create();

        $response = $this->get(route('billing-transaction.edit', $billingTransaction));

        $response->assertOk();
        $response->assertViewIs('billingTransaction.edit');
        $response->assertViewHas('billingTransaction');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BillingTransactionController::class,
            'update',
            \App\Http\Requests\BillingTransactionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $billingTransaction = BillingTransaction::factory()->create();
        $payment_amount = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $patient_visit = PatientVisit::factory()->create();
        $billing_invoice = BillingInvoice::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('billing-transaction.update', $billingTransaction), [
            'payment_amount' => $payment_amount,
            'status' => $status,
            'patient_visit_id' => $patient_visit->id,
            'billing_invoice_id' => $billing_invoice->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $billingTransaction->refresh();

        $response->assertRedirect(route('billingTransaction.index'));
        $response->assertSessionHas('billingTransaction.id', $billingTransaction->id);

        $this->assertEquals($payment_amount, $billingTransaction->payment_amount);
        $this->assertEquals($status, $billingTransaction->status);
        $this->assertEquals($patient_visit->id, $billingTransaction->patient_visit_id);
        $this->assertEquals($billing_invoice->id, $billingTransaction->billing_invoice_id);
        $this->assertEquals($created_by->id, $billingTransaction->created_by_id);
        $this->assertEquals($updated_by->id, $billingTransaction->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $billingTransaction = BillingTransaction::factory()->create();

        $response = $this->delete(route('billing-transaction.destroy', $billingTransaction));

        $response->assertRedirect(route('billingTransaction.index'));

        $this->assertModelMissing($billingTransaction);
    }
}
