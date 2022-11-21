<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CreatedBy;
use App\Models\LabTest;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LabTestController
 */
class LabTestControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $labTests = LabTest::factory()->count(3)->create();

        $response = $this->get(route('lab-test.index'));

        $response->assertOk();
        $response->assertViewIs('labTest.index');
        $response->assertViewHas('labTests');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('lab-test.create'));

        $response->assertOk();
        $response->assertViewIs('labTest.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LabTestController::class,
            'store',
            \App\Http\Requests\LabTestStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $price = $this->faker->numberBetween(-10000, 10000);
        $percentage = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('lab-test.store'), [
            'price' => $price,
            'percentage' => $percentage,
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $labTests = LabTest::query()
            ->where('price', $price)
            ->where('percentage', $percentage)
            ->where('status', $status)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $labTests);
        $labTest = $labTests->first();

        $response->assertRedirect(route('labTest.index'));
        $response->assertSessionHas('labTest.id', $labTest->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $labTest = LabTest::factory()->create();

        $response = $this->get(route('lab-test.show', $labTest));

        $response->assertOk();
        $response->assertViewIs('labTest.show');
        $response->assertViewHas('labTest');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $labTest = LabTest::factory()->create();

        $response = $this->get(route('lab-test.edit', $labTest));

        $response->assertOk();
        $response->assertViewIs('labTest.edit');
        $response->assertViewHas('labTest');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LabTestController::class,
            'update',
            \App\Http\Requests\LabTestUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $labTest = LabTest::factory()->create();
        $price = $this->faker->numberBetween(-10000, 10000);
        $percentage = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('lab-test.update', $labTest), [
            'price' => $price,
            'percentage' => $percentage,
            'status' => $status,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $labTest->refresh();

        $response->assertRedirect(route('labTest.index'));
        $response->assertSessionHas('labTest.id', $labTest->id);

        $this->assertEquals($price, $labTest->price);
        $this->assertEquals($percentage, $labTest->percentage);
        $this->assertEquals($status, $labTest->status);
        $this->assertEquals($created_by->id, $labTest->created_by_id);
        $this->assertEquals($updated_by->id, $labTest->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $labTest = LabTest::factory()->create();

        $response = $this->delete(route('lab-test.destroy', $labTest));

        $response->assertRedirect(route('labTest.index'));

        $this->assertModelMissing($labTest);
    }
}
