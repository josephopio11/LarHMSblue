<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\DoctorOrder;
use App\Models\PatientVisit;
use App\Models\UpdatedBy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DoctorOrderController
 */
class DoctorOrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $doctorOrders = DoctorOrder::factory()->count(3)->create();

        $response = $this->get(route('doctor-order.index'));

        $response->assertOk();
        $response->assertViewIs('doctorOrder.index');
        $response->assertViewHas('doctorOrders');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('doctor-order.create'));

        $response->assertOk();
        $response->assertViewIs('doctorOrder.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DoctorOrderController::class,
            'store',
            \App\Http\Requests\DoctorOrderStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $status = $this->faker->word;
        $patient_visit = PatientVisit::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('doctor-order.store'), [
            'status' => $status,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $doctorOrders = DoctorOrder::query()
            ->where('status', $status)
            ->where('patient_visit_id', $patient_visit->id)
            ->where('user_id', $user->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $doctorOrders);
        $doctorOrder = $doctorOrders->first();

        $response->assertRedirect(route('doctorOrder.index'));
        $response->assertSessionHas('doctorOrder.id', $doctorOrder->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $doctorOrder = DoctorOrder::factory()->create();

        $response = $this->get(route('doctor-order.show', $doctorOrder));

        $response->assertOk();
        $response->assertViewIs('doctorOrder.show');
        $response->assertViewHas('doctorOrder');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $doctorOrder = DoctorOrder::factory()->create();

        $response = $this->get(route('doctor-order.edit', $doctorOrder));

        $response->assertOk();
        $response->assertViewIs('doctorOrder.edit');
        $response->assertViewHas('doctorOrder');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DoctorOrderController::class,
            'update',
            \App\Http\Requests\DoctorOrderUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $doctorOrder = DoctorOrder::factory()->create();
        $status = $this->faker->word;
        $patient_visit = PatientVisit::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('doctor-order.update', $doctorOrder), [
            'status' => $status,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $doctorOrder->refresh();

        $response->assertRedirect(route('doctorOrder.index'));
        $response->assertSessionHas('doctorOrder.id', $doctorOrder->id);

        $this->assertEquals($status, $doctorOrder->status);
        $this->assertEquals($patient_visit->id, $doctorOrder->patient_visit_id);
        $this->assertEquals($user->id, $doctorOrder->user_id);
        $this->assertEquals($created_by->id, $doctorOrder->created_by_id);
        $this->assertEquals($updated_by->id, $doctorOrder->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $doctorOrder = DoctorOrder::factory()->create();

        $response = $this->delete(route('doctor-order.destroy', $doctorOrder));

        $response->assertRedirect(route('doctorOrder.index'));

        $this->assertModelMissing($doctorOrder);
    }
}
