<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\OperationType;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OperationTypeController
 */
class OperationTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $operationTypes = OperationType::factory()->count(3)->create();

        $response = $this->get(route('operation-type.index'));

        $response->assertOk();
        $response->assertViewIs('operationType.index');
        $response->assertViewHas('operationTypes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('operation-type.create'));

        $response->assertOk();
        $response->assertViewIs('operationType.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OperationTypeController::class,
            'store',
            \App\Http\Requests\OperationTypeStoreRequest::class
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

        $response = $this->post(route('operation-type.store'), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $operationTypes = OperationType::query()
            ->where('status', $status)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $operationTypes);
        $operationType = $operationTypes->first();

        $response->assertRedirect(route('operationType.index'));
        $response->assertSessionHas('operationType.id', $operationType->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $operationType = OperationType::factory()->create();

        $response = $this->get(route('operation-type.show', $operationType));

        $response->assertOk();
        $response->assertViewIs('operationType.show');
        $response->assertViewHas('operationType');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $operationType = OperationType::factory()->create();

        $response = $this->get(route('operation-type.edit', $operationType));

        $response->assertOk();
        $response->assertViewIs('operationType.edit');
        $response->assertViewHas('operationType');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OperationTypeController::class,
            'update',
            \App\Http\Requests\OperationTypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $operationType = OperationType::factory()->create();
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('operation-type.update', $operationType), [
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $operationType->refresh();

        $response->assertRedirect(route('operationType.index'));
        $response->assertSessionHas('operationType.id', $operationType->id);

        $this->assertEquals($status, $operationType->status);
        $this->assertEquals($created_by->id, $operationType->created_by_id);
        $this->assertEquals($updated_by->id, $operationType->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $operationType = OperationType::factory()->create();

        $response = $this->delete(route('operation-type.destroy', $operationType));

        $response->assertRedirect(route('operationType.index'));

        $this->assertModelMissing($operationType);
    }
}
