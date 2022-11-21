<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\TestType;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TestTypeController
 */
class TestTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $testTypes = TestType::factory()->count(3)->create();

        $response = $this->get(route('test-type.index'));

        $response->assertOk();
        $response->assertViewIs('testType.index');
        $response->assertViewHas('testTypes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('test-type.create'));

        $response->assertOk();
        $response->assertViewIs('testType.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TestTypeController::class,
            'store',
            \App\Http\Requests\TestTypeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $price = $this->faker->numberBetween(-10000, 10000);
        $discount = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('test-type.store'), [
            'price' => $price,
            'discount' => $discount,
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $testTypes = TestType::query()
            ->where('price', $price)
            ->where('discount', $discount)
            ->where('status', $status)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $testTypes);
        $testType = $testTypes->first();

        $response->assertRedirect(route('testType.index'));
        $response->assertSessionHas('testType.id', $testType->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $testType = TestType::factory()->create();

        $response = $this->get(route('test-type.show', $testType));

        $response->assertOk();
        $response->assertViewIs('testType.show');
        $response->assertViewHas('testType');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $testType = TestType::factory()->create();

        $response = $this->get(route('test-type.edit', $testType));

        $response->assertOk();
        $response->assertViewIs('testType.edit');
        $response->assertViewHas('testType');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TestTypeController::class,
            'update',
            \App\Http\Requests\TestTypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $testType = TestType::factory()->create();
        $price = $this->faker->numberBetween(-10000, 10000);
        $discount = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('test-type.update', $testType), [
            'price' => $price,
            'discount' => $discount,
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $testType->refresh();

        $response->assertRedirect(route('testType.index'));
        $response->assertSessionHas('testType.id', $testType->id);

        $this->assertEquals($price, $testType->price);
        $this->assertEquals($discount, $testType->discount);
        $this->assertEquals($status, $testType->status);
        $this->assertEquals($created_by->id, $testType->created_by_id);
        $this->assertEquals($updated_by->id, $testType->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $testType = TestType::factory()->create();

        $response = $this->delete(route('test-type.destroy', $testType));

        $response->assertRedirect(route('testType.index'));

        $this->assertModelMissing($testType);
    }
}
