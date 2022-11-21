<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\BloodDonor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BloodDonorController
 */
class BloodDonorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $bloodDonors = BloodDonor::factory()->count(3)->create();

        $response = $this->get(route('blood-donor.index'));

        $response->assertOk();
        $response->assertViewIs('bloodDonor.index');
        $response->assertViewHas('bloodDonors');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('blood-donor.create'));

        $response->assertOk();
        $response->assertViewIs('bloodDonor.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BloodDonorController::class,
            'store',
            \App\Http\Requests\BloodDonorStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $softDelete = $this->faker->word;

        $response = $this->post(route('blood-donor.store'), [
            'softDelete' => $softDelete,
        ]);

        $bloodDonors = BloodDonor::query()
            ->where('softDelete', $softDelete)
            ->get();
        $this->assertCount(1, $bloodDonors);
        $bloodDonor = $bloodDonors->first();

        $response->assertRedirect(route('bloodDonor.index'));
        $response->assertSessionHas('bloodDonor.id', $bloodDonor->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $bloodDonor = BloodDonor::factory()->create();

        $response = $this->get(route('blood-donor.show', $bloodDonor));

        $response->assertOk();
        $response->assertViewIs('bloodDonor.show');
        $response->assertViewHas('bloodDonor');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $bloodDonor = BloodDonor::factory()->create();

        $response = $this->get(route('blood-donor.edit', $bloodDonor));

        $response->assertOk();
        $response->assertViewIs('bloodDonor.edit');
        $response->assertViewHas('bloodDonor');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BloodDonorController::class,
            'update',
            \App\Http\Requests\BloodDonorUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $bloodDonor = BloodDonor::factory()->create();
        $softDelete = $this->faker->word;

        $response = $this->put(route('blood-donor.update', $bloodDonor), [
            'softDelete' => $softDelete,
        ]);

        $bloodDonor->refresh();

        $response->assertRedirect(route('bloodDonor.index'));
        $response->assertSessionHas('bloodDonor.id', $bloodDonor->id);

        $this->assertEquals($softDelete, $bloodDonor->softDelete);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $bloodDonor = BloodDonor::factory()->create();

        $response = $this->delete(route('blood-donor.destroy', $bloodDonor));

        $response->assertRedirect(route('bloodDonor.index'));

        $this->assertModelMissing($bloodDonor);
    }
}
