<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\UpdatedBy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DoctorController
 */
class DoctorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $doctors = Doctor::factory()->count(3)->create();

        $response = $this->get(route('doctor.index'));

        $response->assertOk();
        $response->assertViewIs('doctor.index');
        $response->assertViewHas('doctors');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('doctor.create'));

        $response->assertOk();
        $response->assertViewIs('doctor.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DoctorController::class,
            'store',
            \App\Http\Requests\DoctorStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $charge = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $user = User::factory()->create();
        $specialist = Specialist::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('doctor.store'), [
            'charge' => $charge,
            'status' => $status,
            'user_id' => $user->id,
            'specialist_id' => $specialist->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $doctors = Doctor::query()
            ->where('charge', $charge)
            ->where('status', $status)
            ->where('user_id', $user->id)
            ->where('specialist_id', $specialist->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $doctors);
        $doctor = $doctors->first();

        $response->assertRedirect(route('doctor.index'));
        $response->assertSessionHas('doctor.id', $doctor->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->get(route('doctor.show', $doctor));

        $response->assertOk();
        $response->assertViewIs('doctor.show');
        $response->assertViewHas('doctor');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->get(route('doctor.edit', $doctor));

        $response->assertOk();
        $response->assertViewIs('doctor.edit');
        $response->assertViewHas('doctor');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DoctorController::class,
            'update',
            \App\Http\Requests\DoctorUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $doctor = Doctor::factory()->create();
        $charge = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $user = User::factory()->create();
        $specialist = Specialist::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('doctor.update', $doctor), [
            'charge' => $charge,
            'status' => $status,
            'user_id' => $user->id,
            'specialist_id' => $specialist->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $doctor->refresh();

        $response->assertRedirect(route('doctor.index'));
        $response->assertSessionHas('doctor.id', $doctor->id);

        $this->assertEquals($charge, $doctor->charge);
        $this->assertEquals($status, $doctor->status);
        $this->assertEquals($user->id, $doctor->user_id);
        $this->assertEquals($specialist->id, $doctor->specialist_id);
        $this->assertEquals($created_by->id, $doctor->created_by_id);
        $this->assertEquals($updated_by->id, $doctor->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->delete(route('doctor.destroy', $doctor));

        $response->assertRedirect(route('doctor.index'));

        $this->assertModelMissing($doctor);
    }
}
