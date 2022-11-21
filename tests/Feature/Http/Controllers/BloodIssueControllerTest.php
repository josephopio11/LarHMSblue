<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\BloodIssue;
use App\Models\BloodRequest;
use App\Models\BloodStockDetail;
use App\Models\CreatedBy;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BloodIssueController
 */
class BloodIssueControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $bloodIssues = BloodIssue::factory()->count(3)->create();

        $response = $this->get(route('blood-issue.index'));

        $response->assertOk();
        $response->assertViewIs('bloodIssue.index');
        $response->assertViewHas('bloodIssues');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('blood-issue.create'));

        $response->assertOk();
        $response->assertViewIs('bloodIssue.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BloodIssueController::class,
            'store',
            \App\Http\Requests\BloodIssueStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $unit = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $blood_request = BloodRequest::factory()->create();
        $blood_stock_detail = BloodStockDetail::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('blood-issue.store'), [
            'unit' => $unit,
            'status' => $status,
            'blood_request_id' => $blood_request->id,
            'blood_stock_detail_id' => $blood_stock_detail->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $bloodIssues = BloodIssue::query()
            ->where('unit', $unit)
            ->where('status', $status)
            ->where('blood_request_id', $blood_request->id)
            ->where('blood_stock_detail_id', $blood_stock_detail->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $bloodIssues);
        $bloodIssue = $bloodIssues->first();

        $response->assertRedirect(route('bloodIssue.index'));
        $response->assertSessionHas('bloodIssue.id', $bloodIssue->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $bloodIssue = BloodIssue::factory()->create();

        $response = $this->get(route('blood-issue.show', $bloodIssue));

        $response->assertOk();
        $response->assertViewIs('bloodIssue.show');
        $response->assertViewHas('bloodIssue');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $bloodIssue = BloodIssue::factory()->create();

        $response = $this->get(route('blood-issue.edit', $bloodIssue));

        $response->assertOk();
        $response->assertViewIs('bloodIssue.edit');
        $response->assertViewHas('bloodIssue');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BloodIssueController::class,
            'update',
            \App\Http\Requests\BloodIssueUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $bloodIssue = BloodIssue::factory()->create();
        $unit = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word;
        $blood_request = BloodRequest::factory()->create();
        $blood_stock_detail = BloodStockDetail::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('blood-issue.update', $bloodIssue), [
            'unit' => $unit,
            'status' => $status,
            'blood_request_id' => $blood_request->id,
            'blood_stock_detail_id' => $blood_stock_detail->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $bloodIssue->refresh();

        $response->assertRedirect(route('bloodIssue.index'));
        $response->assertSessionHas('bloodIssue.id', $bloodIssue->id);

        $this->assertEquals($unit, $bloodIssue->unit);
        $this->assertEquals($status, $bloodIssue->status);
        $this->assertEquals($blood_request->id, $bloodIssue->blood_request_id);
        $this->assertEquals($blood_stock_detail->id, $bloodIssue->blood_stock_detail_id);
        $this->assertEquals($created_by->id, $bloodIssue->created_by_id);
        $this->assertEquals($updated_by->id, $bloodIssue->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $bloodIssue = BloodIssue::factory()->create();

        $response = $this->delete(route('blood-issue.destroy', $bloodIssue));

        $response->assertRedirect(route('bloodIssue.index'));

        $this->assertModelMissing($bloodIssue);
    }
}
