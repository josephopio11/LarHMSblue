<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\DoctorOrder;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\PharmacyInvoice;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PharmacyInvoiceController
 */
class PharmacyInvoiceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $pharmacyInvoices = PharmacyInvoice::factory()->count(3)->create();

        $response = $this->get(route('pharmacy-invoice.index'));

        $response->assertOk();
        $response->assertViewIs('pharmacyInvoice.index');
        $response->assertViewHas('pharmacyInvoices');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('pharmacy-invoice.create'));

        $response->assertOk();
        $response->assertViewIs('pharmacyInvoice.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PharmacyInvoiceController::class,
            'store',
            \App\Http\Requests\PharmacyInvoiceStoreRequest::class
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

        $response = $this->post(route('pharmacy-invoice.store'), [
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

        $pharmacyInvoices = PharmacyInvoice::query()
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
        $this->assertCount(1, $pharmacyInvoices);
        $pharmacyInvoice = $pharmacyInvoices->first();

        $response->assertRedirect(route('pharmacyInvoice.index'));
        $response->assertSessionHas('pharmacyInvoice.id', $pharmacyInvoice->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $pharmacyInvoice = PharmacyInvoice::factory()->create();

        $response = $this->get(route('pharmacy-invoice.show', $pharmacyInvoice));

        $response->assertOk();
        $response->assertViewIs('pharmacyInvoice.show');
        $response->assertViewHas('pharmacyInvoice');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $pharmacyInvoice = PharmacyInvoice::factory()->create();

        $response = $this->get(route('pharmacy-invoice.edit', $pharmacyInvoice));

        $response->assertOk();
        $response->assertViewIs('pharmacyInvoice.edit');
        $response->assertViewHas('pharmacyInvoice');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PharmacyInvoiceController::class,
            'update',
            \App\Http\Requests\PharmacyInvoiceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $pharmacyInvoice = PharmacyInvoice::factory()->create();
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

        $response = $this->put(route('pharmacy-invoice.update', $pharmacyInvoice), [
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

        $pharmacyInvoice->refresh();

        $response->assertRedirect(route('pharmacyInvoice.index'));
        $response->assertSessionHas('pharmacyInvoice.id', $pharmacyInvoice->id);

        $this->assertEquals($total, $pharmacyInvoice->total);
        $this->assertEquals($pending_amount, $pharmacyInvoice->pending_amount);
        $this->assertEquals($paid_amount, $pharmacyInvoice->paid_amount);
        $this->assertEquals($mode, $pharmacyInvoice->mode);
        $this->assertEquals($discount_amount, $pharmacyInvoice->discount_amount);
        $this->assertEquals($tax, $pharmacyInvoice->tax);
        $this->assertEquals($additional_charge, $pharmacyInvoice->additional_charge);
        $this->assertEquals($status, $pharmacyInvoice->status);
        $this->assertEquals($patient->id, $pharmacyInvoice->patient_id);
        $this->assertEquals($patient_visit->id, $pharmacyInvoice->patient_visit_id);
        $this->assertEquals($doctor_order->id, $pharmacyInvoice->doctor_order_id);
        $this->assertEquals($created_by->id, $pharmacyInvoice->created_by_id);
        $this->assertEquals($updated_by->id, $pharmacyInvoice->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $pharmacyInvoice = PharmacyInvoice::factory()->create();

        $response = $this->delete(route('pharmacy-invoice.destroy', $pharmacyInvoice));

        $response->assertRedirect(route('pharmacyInvoice.index'));

        $this->assertModelMissing($pharmacyInvoice);
    }
}
