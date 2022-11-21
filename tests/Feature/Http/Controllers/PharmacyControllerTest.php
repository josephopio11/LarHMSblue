<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Branch;
use App\Models\CreatedBy;
use App\Models\Pharmacy;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PharmacyController
 */
class PharmacyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $pharmacies = Pharmacy::factory()->count(3)->create();

        $response = $this->get(route('pharmacy.index'));

        $response->assertOk();
        $response->assertViewIs('pharmacy.index');
        $response->assertViewHas('pharmacies');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('pharmacy.create'));

        $response->assertOk();
        $response->assertViewIs('pharmacy.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PharmacyController::class,
            'store',
            \App\Http\Requests\PharmacyStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $status = $this->faker->word;
        $branch = Branch::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('pharmacy.store'), [
            'status' => $status,
            'branch_id' => $branch->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $pharmacies = Pharmacy::query()
            ->where('status', $status)
            ->where('branch_id', $branch->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $pharmacies);
        $pharmacy = $pharmacies->first();

        $response->assertRedirect(route('pharmacy.index'));
        $response->assertSessionHas('pharmacy.id', $pharmacy->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $pharmacy = Pharmacy::factory()->create();

        $response = $this->get(route('pharmacy.show', $pharmacy));

        $response->assertOk();
        $response->assertViewIs('pharmacy.show');
        $response->assertViewHas('pharmacy');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $pharmacy = Pharmacy::factory()->create();

        $response = $this->get(route('pharmacy.edit', $pharmacy));

        $response->assertOk();
        $response->assertViewIs('pharmacy.edit');
        $response->assertViewHas('pharmacy');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PharmacyController::class,
            'update',
            \App\Http\Requests\PharmacyUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $pharmacy = Pharmacy::factory()->create();
        $status = $this->faker->word;
        $branch = Branch::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('pharmacy.update', $pharmacy), [
            'status' => $status,
            'branch_id' => $branch->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $pharmacy->refresh();

        $response->assertRedirect(route('pharmacy.index'));
        $response->assertSessionHas('pharmacy.id', $pharmacy->id);

        $this->assertEquals($status, $pharmacy->status);
        $this->assertEquals($branch->id, $pharmacy->branch_id);
        $this->assertEquals($created_by->id, $pharmacy->created_by_id);
        $this->assertEquals($updated_by->id, $pharmacy->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $pharmacy = Pharmacy::factory()->create();

        $response = $this->delete(route('pharmacy.destroy', $pharmacy));

        $response->assertRedirect(route('pharmacy.index'));

        $this->assertModelMissing($pharmacy);
    }
}
