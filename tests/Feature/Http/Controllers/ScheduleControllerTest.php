<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Schedule;
use App\Models\UpdatedBy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ScheduleController
 */
class ScheduleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $schedules = Schedule::factory()->count(3)->create();

        $response = $this->get(route('schedule.index'));

        $response->assertOk();
        $response->assertViewIs('schedule.index');
        $response->assertViewHas('schedules');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('schedule.create'));

        $response->assertOk();
        $response->assertViewIs('schedule.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ScheduleController::class,
            'store',
            \App\Http\Requests\ScheduleStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $status = $this->faker->word;
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('schedule.store'), [
            'status' => $status,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $schedules = Schedule::query()
            ->where('status', $status)
            ->where('user_id', $user->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $schedules);
        $schedule = $schedules->first();

        $response->assertRedirect(route('schedule.index'));
        $response->assertSessionHas('schedule.id', $schedule->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $schedule = Schedule::factory()->create();

        $response = $this->get(route('schedule.show', $schedule));

        $response->assertOk();
        $response->assertViewIs('schedule.show');
        $response->assertViewHas('schedule');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $schedule = Schedule::factory()->create();

        $response = $this->get(route('schedule.edit', $schedule));

        $response->assertOk();
        $response->assertViewIs('schedule.edit');
        $response->assertViewHas('schedule');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ScheduleController::class,
            'update',
            \App\Http\Requests\ScheduleUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $schedule = Schedule::factory()->create();
        $status = $this->faker->word;
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('schedule.update', $schedule), [
            'status' => $status,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $schedule->refresh();

        $response->assertRedirect(route('schedule.index'));
        $response->assertSessionHas('schedule.id', $schedule->id);

        $this->assertEquals($status, $schedule->status);
        $this->assertEquals($user->id, $schedule->user_id);
        $this->assertEquals($created_by->id, $schedule->created_by_id);
        $this->assertEquals($updated_by->id, $schedule->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $schedule = Schedule::factory()->create();

        $response = $this->delete(route('schedule.destroy', $schedule));

        $response->assertRedirect(route('schedule.index'));

        $this->assertModelMissing($schedule);
    }
}
