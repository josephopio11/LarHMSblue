<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Advice;
use App\Models\CreatedBy;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AdviceController
 */
class AdviceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $advice = Advice::factory()->count(3)->create();

        $response = $this->get(route('advice.index'));

        $response->assertOk();
        $response->assertViewIs('advice.index');
        $response->assertViewHas('advice');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('advice.create'));

        $response->assertOk();
        $response->assertViewIs('advice.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AdviceController::class,
            'store',
            \App\Http\Requests\AdviceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('advice.store'), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $advice = Advice::query()
            ->where('status', $status)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $advice);
        $advice = $advice->first();

        $response->assertRedirect(route('advice.index'));
        $response->assertSessionHas('advice.id', $advice->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $advice = Advice::factory()->create();

        $response = $this->get(route('advice.show', $advice));

        $response->assertOk();
        $response->assertViewIs('advice.show');
        $response->assertViewHas('advice');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $advice = Advice::factory()->create();

        $response = $this->get(route('advice.edit', $advice));

        $response->assertOk();
        $response->assertViewIs('advice.edit');
        $response->assertViewHas('advice');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AdviceController::class,
            'update',
            \App\Http\Requests\AdviceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $advice = Advice::factory()->create();
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('advice.update', $advice), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $advice->refresh();

        $response->assertRedirect(route('advice.index'));
        $response->assertSessionHas('advice.id', $advice->id);

        $this->assertEquals($status, $advice->status);
        $this->assertEquals($created_by->id, $advice->created_by_id);
        $this->assertEquals($updated_by->id, $advice->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $advice = Advice::factory()->create();

        $response = $this->delete(route('advice.destroy', $advice));

        $response->assertRedirect(route('advice.index'));

        $this->assertModelMissing($advice);
    }
}
