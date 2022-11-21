<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\PatientVisit;
use App\Models\PharmacyInvoice;
use App\Models\PharmacyTransaction;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PharmacyTransactionController
 */
class PharmacyTransactionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $pharmacyTransactions = PharmacyTransaction::factory()->count(3)->create();

        $response = $this->get(route('pharmacy-transaction.index'));

        $response->assertOk();
        $response->assertViewIs('pharmacyTransaction.index');
        $response->assertViewHas('pharmacyTransactions');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('pharmacy-transaction.create'));

        $response->assertOk();
        $response->assertViewIs('pharmacyTransaction.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PharmacyTransactionController::class,
            'store',
            \App\Http\Requests\PharmacyTransactionStoreRequest::class
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
        $pharmacy_invoice = PharmacyInvoice::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('pharmacy-transaction.store'), [
            'payment_amount' => $payment_amount,
            'status' => $status,
            'patient_visit_id' => $patient_visit->id,
            'pharmacy_invoice_id' => $pharmacy_invoice->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $pharmacyTransactions = PharmacyTransaction::query()
            ->where('payment_amount', $payment_amount)
            ->where('status', $status)
            ->where('patient_visit_id', $patient_visit->id)
            ->where('pharmacy_invoice_id', $pharmacy_invoice->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $pharmacyTransactions);
        $pharmacyTransaction = $pharmacyTransactions->first();

        $response->assertRedirect(route('pharmacyTransaction.index'));
        $response->assertSessionHas('pharmacyTransaction.id', $pharmacyTransaction->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $pharmacyTransaction = PharmacyTransaction::factory()->create();

        $response = $this->get(route('pharmacy-transaction.show', $pharmacyTransaction));

        $response->assertOk();
        $response->assertViewIs('pharmacyTransaction.show');
        $response->assertViewHas('pharmacyTransaction');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $pharmacyTransaction = PharmacyTransaction::factory()->create();

        $response = $this->get(route('pharmacy-transaction.edit', $pharmacyTransaction));

        $response->assertOk();
        $response->assertViewIs('pharmacyTransaction.edit');
        $response->assertViewHas('pharmacyTransaction');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PharmacyTransactionController::class,
            'update',
            \App\Http\Requests\PharmacyTransactionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $pharmacyTransaction = PharmacyTransaction::factory()->create();
        $payment_amount = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $patient_visit = PatientVisit::factory()->create();
        $pharmacy_invoice = PharmacyInvoice::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('pharmacy-transaction.update', $pharmacyTransaction), [
            'payment_amount' => $payment_amount,
            'status' => $status,
            'patient_visit_id' => $patient_visit->id,
            'pharmacy_invoice_id' => $pharmacy_invoice->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $pharmacyTransaction->refresh();

        $response->assertRedirect(route('pharmacyTransaction.index'));
        $response->assertSessionHas('pharmacyTransaction.id', $pharmacyTransaction->id);

        $this->assertEquals($payment_amount, $pharmacyTransaction->payment_amount);
        $this->assertEquals($status, $pharmacyTransaction->status);
        $this->assertEquals($patient_visit->id, $pharmacyTransaction->patient_visit_id);
        $this->assertEquals($pharmacy_invoice->id, $pharmacyTransaction->pharmacy_invoice_id);
        $this->assertEquals($created_by->id, $pharmacyTransaction->created_by_id);
        $this->assertEquals($updated_by->id, $pharmacyTransaction->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $pharmacyTransaction = PharmacyTransaction::factory()->create();

        $response = $this->delete(route('pharmacy-transaction.destroy', $pharmacyTransaction));

        $response->assertRedirect(route('pharmacyTransaction.index'));

        $this->assertModelMissing($pharmacyTransaction);
    }
}
