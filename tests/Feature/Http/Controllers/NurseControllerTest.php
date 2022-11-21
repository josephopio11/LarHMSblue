<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Nurse;
use App\Models\Specialist;
use App\Models\UpdatedBy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\NurseController
 */
class NurseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $nurses = Nurse::factory()->count(3)->create();

        $response = $this->get(route('nurse.index'));

        $response->assertOk();
        $response->assertViewIs('nurse.index');
        $response->assertViewHas('nurses');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('nurse.create'));

        $response->assertOk();
        $response->assertViewIs('nurse.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\NurseController::class,
            'store',
            \App\Http\Requests\NurseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $status = $this->faker->word;
        $user = User::factory()->create();
        $specialist = Specialist::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('nurse.store'), [
            'status' => $status,
            'user_id' => $user->id,
            'specialist_id' => $specialist->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $nurses = Nurse::query()
            ->where('status', $status)
            ->where('user_id', $user->id)
            ->where('specialist_id', $specialist->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $nurses);
        $nurse = $nurses->first();

        $response->assertRedirect(route('nurse.index'));
        $response->assertSessionHas('nurse.id', $nurse->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $nurse = Nurse::factory()->create();

        $response = $this->get(route('nurse.show', $nurse));

        $response->assertOk();
        $response->assertViewIs('nurse.show');
        $response->assertViewHas('nurse');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $nurse = Nurse::factory()->create();

        $response = $this->get(route('nurse.edit', $nurse));

        $response->assertOk();
        $response->assertViewIs('nurse.edit');
        $response->assertViewHas('nurse');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\NurseController::class,
            'update',
            \App\Http\Requests\NurseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $nurse = Nurse::factory()->create();
        $status = $this->faker->word;
        $user = User::factory()->create();
        $specialist = Specialist::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('nurse.update', $nurse), [
            'status' => $status,
            'user_id' => $user->id,
            'specialist_id' => $specialist->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $nurse->refresh();

        $response->assertRedirect(route('nurse.index'));
        $response->assertSessionHas('nurse.id', $nurse->id);

        $this->assertEquals($status, $nurse->status);
        $this->assertEquals($user->id, $nurse->user_id);
        $this->assertEquals($specialist->id, $nurse->specialist_id);
        $this->assertEquals($created_by->id, $nurse->created_by_id);
        $this->assertEquals($updated_by->id, $nurse->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $nurse = Nurse::factory()->create();

        $response = $this->delete(route('nurse.destroy', $nurse));

        $response->assertRedirect(route('nurse.index'));

        $this->assertModelMissing($nurse);
    }
}
