<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\UpdatedBy;
use App\Models\User;
use App\Models\Vital;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VitalController
 */
class VitalControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $vitals = Vital::factory()->count(3)->create();

        $response = $this->get(route('vital.index'));

        $response->assertOk();
        $response->assertViewIs('vital.index');
        $response->assertViewHas('vitals');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('vital.create'));

        $response->assertOk();
        $response->assertViewIs('vital.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VitalController::class,
            'store',
            \App\Http\Requests\VitalStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $systolic_b_p = $this->faker->numberBetween(-10000, 10000);
        $diastolic_b_p = $this->faker->numberBetween(-10000, 10000);
        $temperature = $this->faker->numberBetween(-10000, 10000);
        $weight = $this->faker->numberBetween(-10000, 10000);
        $height = $this->faker->numberBetween(-10000, 10000);
        $pulse = $this->faker->numberBetween(-10000, 10000);
        $respiratory_rate = $this->faker->numberBetween(-10000, 10000);
        $heart_rate = $this->faker->numberBetween(-10000, 10000);
        $urine_output = $this->faker->numberBetween(-10000, 10000);
        $blood_sugar_r = $this->faker->numberBetween(-10000, 10000);
        $blood_sugar_f = $this->faker->numberBetween(-10000, 10000);
        $spo_2 = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('vital.store'), [
            'systolic_b_p' => $systolic_b_p,
            'diastolic_b_p' => $diastolic_b_p,
            'temperature' => $temperature,
            'weight' => $weight,
            'height' => $height,
            'pulse' => $pulse,
            'respiratory_rate' => $respiratory_rate,
            'heart_rate' => $heart_rate,
            'urine_output' => $urine_output,
            'blood_sugar_r' => $blood_sugar_r,
            'blood_sugar_f' => $blood_sugar_f,
            'spo_2' => $spo_2,
            'status' => $status,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $vitals = Vital::query()
            ->where('systolic_b_p', $systolic_b_p)
            ->where('diastolic_b_p', $diastolic_b_p)
            ->where('temperature', $temperature)
            ->where('weight', $weight)
            ->where('height', $height)
            ->where('pulse', $pulse)
            ->where('respiratory_rate', $respiratory_rate)
            ->where('heart_rate', $heart_rate)
            ->where('urine_output', $urine_output)
            ->where('blood_sugar_r', $blood_sugar_r)
            ->where('blood_sugar_f', $blood_sugar_f)
            ->where('spo_2', $spo_2)
            ->where('status', $status)
            ->where('patient_id', $patient->id)
            ->where('patient_visit_id', $patient_visit->id)
            ->where('user_id', $user->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $vitals);
        $vital = $vitals->first();

        $response->assertRedirect(route('vital.index'));
        $response->assertSessionHas('vital.id', $vital->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $vital = Vital::factory()->create();

        $response = $this->get(route('vital.show', $vital));

        $response->assertOk();
        $response->assertViewIs('vital.show');
        $response->assertViewHas('vital');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $vital = Vital::factory()->create();

        $response = $this->get(route('vital.edit', $vital));

        $response->assertOk();
        $response->assertViewIs('vital.edit');
        $response->assertViewHas('vital');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VitalController::class,
            'update',
            \App\Http\Requests\VitalUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $vital = Vital::factory()->create();
        $systolic_b_p = $this->faker->numberBetween(-10000, 10000);
        $diastolic_b_p = $this->faker->numberBetween(-10000, 10000);
        $temperature = $this->faker->numberBetween(-10000, 10000);
        $weight = $this->faker->numberBetween(-10000, 10000);
        $height = $this->faker->numberBetween(-10000, 10000);
        $pulse = $this->faker->numberBetween(-10000, 10000);
        $respiratory_rate = $this->faker->numberBetween(-10000, 10000);
        $heart_rate = $this->faker->numberBetween(-10000, 10000);
        $urine_output = $this->faker->numberBetween(-10000, 10000);
        $blood_sugar_r = $this->faker->numberBetween(-10000, 10000);
        $blood_sugar_f = $this->faker->numberBetween(-10000, 10000);
        $spo_2 = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $patient_visit = PatientVisit::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('vital.update', $vital), [
            'systolic_b_p' => $systolic_b_p,
            'diastolic_b_p' => $diastolic_b_p,
            'temperature' => $temperature,
            'weight' => $weight,
            'height' => $height,
            'pulse' => $pulse,
            'respiratory_rate' => $respiratory_rate,
            'heart_rate' => $heart_rate,
            'urine_output' => $urine_output,
            'blood_sugar_r' => $blood_sugar_r,
            'blood_sugar_f' => $blood_sugar_f,
            'spo_2' => $spo_2,
            'status' => $status,
            'patient_id' => $patient->id,
            'patient_visit_id' => $patient_visit->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $vital->refresh();

        $response->assertRedirect(route('vital.index'));
        $response->assertSessionHas('vital.id', $vital->id);

        $this->assertEquals($systolic_b_p, $vital->systolic_b_p);
        $this->assertEquals($diastolic_b_p, $vital->diastolic_b_p);
        $this->assertEquals($temperature, $vital->temperature);
        $this->assertEquals($weight, $vital->weight);
        $this->assertEquals($height, $vital->height);
        $this->assertEquals($pulse, $vital->pulse);
        $this->assertEquals($respiratory_rate, $vital->respiratory_rate);
        $this->assertEquals($heart_rate, $vital->heart_rate);
        $this->assertEquals($urine_output, $vital->urine_output);
        $this->assertEquals($blood_sugar_r, $vital->blood_sugar_r);
        $this->assertEquals($blood_sugar_f, $vital->blood_sugar_f);
        $this->assertEquals($spo_2, $vital->spo_2);
        $this->assertEquals($status, $vital->status);
        $this->assertEquals($patient->id, $vital->patient_id);
        $this->assertEquals($patient_visit->id, $vital->patient_visit_id);
        $this->assertEquals($user->id, $vital->user_id);
        $this->assertEquals($created_by->id, $vital->created_by_id);
        $this->assertEquals($updated_by->id, $vital->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $vital = Vital::factory()->create();

        $response = $this->delete(route('vital.destroy', $vital));

        $response->assertRedirect(route('vital.index'));

        $this->assertModelMissing($vital);
    }
}
