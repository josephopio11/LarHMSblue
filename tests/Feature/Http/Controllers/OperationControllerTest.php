<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\Operation;
use App\Models\OperationType;
use App\Models\Patient;
use App\Models\UpdatedBy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OperationController
 */
class OperationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $operations = Operation::factory()->count(3)->create();

        $response = $this->get(route('operation.index'));

        $response->assertOk();
        $response->assertViewIs('operation.index');
        $response->assertViewHas('operations');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('operation.create'));

        $response->assertOk();
        $response->assertViewIs('operation.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OperationController::class,
            'store',
            \App\Http\Requests\OperationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $amount = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $operation_type = OperationType::factory()->create();
        $patient = Patient::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('operation.store'), [
            'amount' => $amount,
            'status' => $status,
            'operation_type_id' => $operation_type->id,
            'patient_id' => $patient->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $operations = Operation::query()
            ->where('amount', $amount)
            ->where('status', $status)
            ->where('operation_type_id', $operation_type->id)
            ->where('patient_id', $patient->id)
            ->where('user_id', $user->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $operations);
        $operation = $operations->first();

        $response->assertRedirect(route('operation.index'));
        $response->assertSessionHas('operation.id', $operation->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $operation = Operation::factory()->create();

        $response = $this->get(route('operation.show', $operation));

        $response->assertOk();
        $response->assertViewIs('operation.show');
        $response->assertViewHas('operation');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $operation = Operation::factory()->create();

        $response = $this->get(route('operation.edit', $operation));

        $response->assertOk();
        $response->assertViewIs('operation.edit');
        $response->assertViewHas('operation');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OperationController::class,
            'update',
            \App\Http\Requests\OperationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $operation = Operation::factory()->create();
        $amount = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $operation_type = OperationType::factory()->create();
        $patient = Patient::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('operation.update', $operation), [
            'amount' => $amount,
            'status' => $status,
            'operation_type_id' => $operation_type->id,
            'patient_id' => $patient->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $operation->refresh();

        $response->assertRedirect(route('operation.index'));
        $response->assertSessionHas('operation.id', $operation->id);

        $this->assertEquals($amount, $operation->amount);
        $this->assertEquals($status, $operation->status);
        $this->assertEquals($operation_type->id, $operation->operation_type_id);
        $this->assertEquals($patient->id, $operation->patient_id);
        $this->assertEquals($user->id, $operation->user_id);
        $this->assertEquals($created_by->id, $operation->created_by_id);
        $this->assertEquals($updated_by->id, $operation->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $operation = Operation::factory()->create();

        $response = $this->delete(route('operation.destroy', $operation));

        $response->assertRedirect(route('operation.index'));

        $this->assertModelMissing($operation);
    }
}
