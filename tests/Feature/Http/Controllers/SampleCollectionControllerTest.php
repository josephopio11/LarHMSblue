<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ApprovedBy;
use App\Models\CreatedBy;
use App\Models\Investigation;
use App\Models\Laboratory;
use App\Models\SampleCollection;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SampleCollectionController
 */
class SampleCollectionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $sampleCollections = SampleCollection::factory()->count(3)->create();

        $response = $this->get(route('sample-collection.index'));

        $response->assertOk();
        $response->assertViewIs('sampleCollection.index');
        $response->assertViewHas('sampleCollections');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('sample-collection.create'));

        $response->assertOk();
        $response->assertViewIs('sampleCollection.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SampleCollectionController::class,
            'store',
            \App\Http\Requests\SampleCollectionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $status = $this->faker->word;
        $investigation = Investigation::factory()->create();
        $laboratory = Laboratory::factory()->create();
        $approved_by = ApprovedBy::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('sample-collection.store'), [
            'status' => $status,
            'investigation_id' => $investigation->id,
            'laboratory_id' => $laboratory->id,
            'approved_by_id' => $approved_by->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $sampleCollections = SampleCollection::query()
            ->where('status', $status)
            ->where('investigation_id', $investigation->id)
            ->where('laboratory_id', $laboratory->id)
            ->where('approved_by_id', $approved_by->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $sampleCollections);
        $sampleCollection = $sampleCollections->first();

        $response->assertRedirect(route('sampleCollection.index'));
        $response->assertSessionHas('sampleCollection.id', $sampleCollection->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $sampleCollection = SampleCollection::factory()->create();

        $response = $this->get(route('sample-collection.show', $sampleCollection));

        $response->assertOk();
        $response->assertViewIs('sampleCollection.show');
        $response->assertViewHas('sampleCollection');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $sampleCollection = SampleCollection::factory()->create();

        $response = $this->get(route('sample-collection.edit', $sampleCollection));

        $response->assertOk();
        $response->assertViewIs('sampleCollection.edit');
        $response->assertViewHas('sampleCollection');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SampleCollectionController::class,
            'update',
            \App\Http\Requests\SampleCollectionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $sampleCollection = SampleCollection::factory()->create();
        $status = $this->faker->word;
        $investigation = Investigation::factory()->create();
        $laboratory = Laboratory::factory()->create();
        $approved_by = ApprovedBy::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('sample-collection.update', $sampleCollection), [
            'status' => $status,
            'investigation_id' => $investigation->id,
            'laboratory_id' => $laboratory->id,
            'approved_by_id' => $approved_by->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $sampleCollection->refresh();

        $response->assertRedirect(route('sampleCollection.index'));
        $response->assertSessionHas('sampleCollection.id', $sampleCollection->id);

        $this->assertEquals($status, $sampleCollection->status);
        $this->assertEquals($investigation->id, $sampleCollection->investigation_id);
        $this->assertEquals($laboratory->id, $sampleCollection->laboratory_id);
        $this->assertEquals($approved_by->id, $sampleCollection->approved_by_id);
        $this->assertEquals($created_by->id, $sampleCollection->created_by_id);
        $this->assertEquals($updated_by->id, $sampleCollection->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $sampleCollection = SampleCollection::factory()->create();

        $response = $this->delete(route('sample-collection.destroy', $sampleCollection));

        $response->assertRedirect(route('sampleCollection.index'));

        $this->assertModelMissing($sampleCollection);
    }
}
