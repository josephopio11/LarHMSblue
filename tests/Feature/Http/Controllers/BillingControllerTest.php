<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ApprovedBy;
use App\Models\Billing;
use App\Models\CreatedBy;
use App\Models\DoctorOrder;
use App\Models\PatientVisit;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BillingController
 */
class BillingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $billings = Billing::factory()->count(3)->create();

        $response = $this->get(route('billing.index'));

        $response->assertOk();
        $response->assertViewIs('billing.index');
        $response->assertViewHas('billings');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('billing.create'));

        $response->assertOk();
        $response->assertViewIs('billing.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BillingController::class,
            'store',
            \App\Http\Requests\BillingStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $status = $this->faker->word;
        $doctor_order = DoctorOrder::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $approved_by = ApprovedBy::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('billing.store'), [
            'status' => $status,
            'doctor_order_id' => $doctor_order->id,
            'patient_visit_id' => $patient_visit->id,
            'approved_by_id' => $approved_by->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $billings = Billing::query()
            ->where('status', $status)
            ->where('doctor_order_id', $doctor_order->id)
            ->where('patient_visit_id', $patient_visit->id)
            ->where('approved_by_id', $approved_by->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $billings);
        $billing = $billings->first();

        $response->assertRedirect(route('billing.index'));
        $response->assertSessionHas('billing.id', $billing->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $billing = Billing::factory()->create();

        $response = $this->get(route('billing.show', $billing));

        $response->assertOk();
        $response->assertViewIs('billing.show');
        $response->assertViewHas('billing');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $billing = Billing::factory()->create();

        $response = $this->get(route('billing.edit', $billing));

        $response->assertOk();
        $response->assertViewIs('billing.edit');
        $response->assertViewHas('billing');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BillingController::class,
            'update',
            \App\Http\Requests\BillingUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $billing = Billing::factory()->create();
        $status = $this->faker->word;
        $doctor_order = DoctorOrder::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $approved_by = ApprovedBy::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('billing.update', $billing), [
            'status' => $status,
            'doctor_order_id' => $doctor_order->id,
            'patient_visit_id' => $patient_visit->id,
            'approved_by_id' => $approved_by->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $billing->refresh();

        $response->assertRedirect(route('billing.index'));
        $response->assertSessionHas('billing.id', $billing->id);

        $this->assertEquals($status, $billing->status);
        $this->assertEquals($doctor_order->id, $billing->doctor_order_id);
        $this->assertEquals($patient_visit->id, $billing->patient_visit_id);
        $this->assertEquals($approved_by->id, $billing->approved_by_id);
        $this->assertEquals($created_by->id, $billing->created_by_id);
        $this->assertEquals($updated_by->id, $billing->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $billing = Billing::factory()->create();

        $response = $this->delete(route('billing.destroy', $billing));

        $response->assertRedirect(route('billing.index'));

        $this->assertModelMissing($billing);
    }
}
