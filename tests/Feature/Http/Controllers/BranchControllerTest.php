<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Branch;
use App\Models\CreatedBy;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BranchController
 */
class BranchControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $branches = Branch::factory()->count(3)->create();

        $response = $this->get(route('branch.index'));

        $response->assertOk();
        $response->assertViewIs('branch.index');
        $response->assertViewHas('branches');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('branch.create'));

        $response->assertOk();
        $response->assertViewIs('branch.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BranchController::class,
            'store',
            \App\Http\Requests\BranchStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('branch.store'), [
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $branches = Branch::query()
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $branches);
        $branch = $branches->first();

        $response->assertRedirect(route('branch.index'));
        $response->assertSessionHas('branch.id', $branch->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $branch = Branch::factory()->create();

        $response = $this->get(route('branch.show', $branch));

        $response->assertOk();
        $response->assertViewIs('branch.show');
        $response->assertViewHas('branch');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $branch = Branch::factory()->create();

        $response = $this->get(route('branch.edit', $branch));

        $response->assertOk();
        $response->assertViewIs('branch.edit');
        $response->assertViewHas('branch');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BranchController::class,
            'update',
            \App\Http\Requests\BranchUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $branch = Branch::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('branch.update', $branch), [
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $branch->refresh();

        $response->assertRedirect(route('branch.index'));
        $response->assertSessionHas('branch.id', $branch->id);

        $this->assertEquals($created_by->id, $branch->created_by_id);
        $this->assertEquals($updated_by->id, $branch->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $branch = Branch::factory()->create();

        $response = $this->delete(route('branch.destroy', $branch));

        $response->assertRedirect(route('branch.index'));

        $this->assertModelMissing($branch);
    }
}
