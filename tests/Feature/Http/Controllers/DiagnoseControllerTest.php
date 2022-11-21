<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Diagnose;
use App\Models\UpdatedBy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DiagnoseController
 */
class DiagnoseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $diagnoses = Diagnose::factory()->count(3)->create();

        $response = $this->get(route('diagnose.index'));

        $response->assertOk();
        $response->assertViewIs('diagnose.index');
        $response->assertViewHas('diagnoses');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('diagnose.create'));

        $response->assertOk();
        $response->assertViewIs('diagnose.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DiagnoseController::class,
            'store',
            \App\Http\Requests\DiagnoseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('diagnose.store'), [
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $diagnoses = Diagnose::query()
            ->where('user_id', $user->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $diagnoses);
        $diagnose = $diagnoses->first();

        $response->assertRedirect(route('diagnose.index'));
        $response->assertSessionHas('diagnose.id', $diagnose->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $diagnose = Diagnose::factory()->create();

        $response = $this->get(route('diagnose.show', $diagnose));

        $response->assertOk();
        $response->assertViewIs('diagnose.show');
        $response->assertViewHas('diagnose');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $diagnose = Diagnose::factory()->create();

        $response = $this->get(route('diagnose.edit', $diagnose));

        $response->assertOk();
        $response->assertViewIs('diagnose.edit');
        $response->assertViewHas('diagnose');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DiagnoseController::class,
            'update',
            \App\Http\Requests\DiagnoseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $diagnose = Diagnose::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('diagnose.update', $diagnose), [
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $diagnose->refresh();

        $response->assertRedirect(route('diagnose.index'));
        $response->assertSessionHas('diagnose.id', $diagnose->id);

        $this->assertEquals($user->id, $diagnose->user_id);
        $this->assertEquals($created_by->id, $diagnose->created_by_id);
        $this->assertEquals($updated_by->id, $diagnose->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $diagnose = Diagnose::factory()->create();

        $response = $this->delete(route('diagnose.destroy', $diagnose));

        $response->assertRedirect(route('diagnose.index'));

        $this->assertModelMissing($diagnose);
    }
}
