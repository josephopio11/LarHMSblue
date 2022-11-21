<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\BillingInvoice;
use App\Models\CreatedBy;
use App\Models\DoctorOrder;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BillingInvoiceController
 */
class BillingInvoiceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $billingInvoices = BillingInvoice::factory()->count(3)->create();

        $response = $this->get(route('billing-invoice.index'));

        $response->assertOk();
        $response->assertViewIs('billingInvoice.index');
        $response->assertViewHas('billingInvoices');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('billing-invoice.create'));

        $response->assertOk();
        $response->assertViewIs('billingInvoice.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BillingInvoiceController::class,
            'store',
            \App\Http\Requests\BillingInvoiceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $total = $this->faker->numberBetween(-10000, 10000);
        $pending_amount = $this->faker->numberBetween(-10000, 10000);
        $paid_amount = $this->faker->numberBetween(-10000, 10000);
        $mode = $this->faker->word;
        $discount_amount = $this->faker->numberBetween(-10000, 10000);
        $tax = $this->faker->numberBetween(-10000, 10000);
        $additional_charge = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $doctor_order = DoctorOrder::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('billing-invoice.store'), [
            'total' => $total,
            'pending_amount' => $pending_amount,
            'paid_amount' => $paid_amount,
            'mode' => $mode,
            'discount_amount' => $discount_amount,
            'tax' => $tax,
            'additional_charge' => $additional_charge,
            'status' => $status,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'doctor_order_id' => $doctor_order->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $billingInvoices = BillingInvoice::query()
            ->where('total', $total)
            ->where('pending_amount', $pending_amount)
            ->where('paid_amount', $paid_amount)
            ->where('mode', $mode)
            ->where('discount_amount', $discount_amount)
            ->where('tax', $tax)
            ->where('additional_charge', $additional_charge)
            ->where('status', $status)
            ->where('patient_id', $patient->id)
            ->where('patient_visit_id', $patient_visit->id)
            ->where('doctor_order_id', $doctor_order->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $billingInvoices);
        $billingInvoice = $billingInvoices->first();

        $response->assertRedirect(route('billingInvoice.index'));
        $response->assertSessionHas('billingInvoice.id', $billingInvoice->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $billingInvoice = BillingInvoice::factory()->create();

        $response = $this->get(route('billing-invoice.show', $billingInvoice));

        $response->assertOk();
        $response->assertViewIs('billingInvoice.show');
        $response->assertViewHas('billingInvoice');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $billingInvoice = BillingInvoice::factory()->create();

        $response = $this->get(route('billing-invoice.edit', $billingInvoice));

        $response->assertOk();
        $response->assertViewIs('billingInvoice.edit');
        $response->assertViewHas('billingInvoice');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BillingInvoiceController::class,
            'update',
            \App\Http\Requests\BillingInvoiceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $billingInvoice = BillingInvoice::factory()->create();
        $total = $this->faker->numberBetween(-10000, 10000);
        $pending_amount = $this->faker->numberBetween(-10000, 10000);
        $paid_amount = $this->faker->numberBetween(-10000, 10000);
        $mode = $this->faker->word;
        $discount_amount = $this->faker->numberBetween(-10000, 10000);
        $tax = $this->faker->numberBetween(-10000, 10000);
        $additional_charge = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $doctor_order = DoctorOrder::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('billing-invoice.update', $billingInvoice), [
            'total' => $total,
            'pending_amount' => $pending_amount,
            'paid_amount' => $paid_amount,
            'mode' => $mode,
            'discount_amount' => $discount_amount,
            'tax' => $tax,
            'additional_charge' => $additional_charge,
            'status' => $status,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'doctor_order_id' => $doctor_order->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $billingInvoice->refresh();

        $response->assertRedirect(route('billingInvoice.index'));
        $response->assertSessionHas('billingInvoice.id', $billingInvoice->id);

        $this->assertEquals($total, $billingInvoice->total);
        $this->assertEquals($pending_amount, $billingInvoice->pending_amount);
        $this->assertEquals($paid_amount, $billingInvoice->paid_amount);
        $this->assertEquals($mode, $billingInvoice->mode);
        $this->assertEquals($discount_amount, $billingInvoice->discount_amount);
        $this->assertEquals($tax, $billingInvoice->tax);
        $this->assertEquals($additional_charge, $billingInvoice->additional_charge);
        $this->assertEquals($status, $billingInvoice->status);
        $this->assertEquals($patient->id, $billingInvoice->patient_id);
        $this->assertEquals($patient_visit->id, $billingInvoice->patient_visit_id);
        $this->assertEquals($doctor_order->id, $billingInvoice->doctor_order_id);
        $this->assertEquals($created_by->id, $billingInvoice->created_by_id);
        $this->assertEquals($updated_by->id, $billingInvoice->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $billingInvoice = BillingInvoice::factory()->create();

        $response = $this->delete(route('billing-invoice.destroy', $billingInvoice));

        $response->assertRedirect(route('billingInvoice.index'));

        $this->assertModelMissing($billingInvoice);
    }
}
