<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\HospitalSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\HospitalSettingController
 */
class HospitalSettingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $hospitalSettings = HospitalSetting::factory()->count(3)->create();

        $response = $this->get(route('hospital-setting.index'));

        $response->assertOk();
        $response->assertViewIs('hospitalSetting.index');
        $response->assertViewHas('hospitalSettings');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('hospital-setting.create'));

        $response->assertOk();
        $response->assertViewIs('hospitalSetting.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HospitalSettingController::class,
            'store',
            \App\Http\Requests\HospitalSettingStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;

        $response = $this->post(route('hospital-setting.store'), [
            'name' => $name,
        ]);

        $hospitalSettings = HospitalSetting::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $hospitalSettings);
        $hospitalSetting = $hospitalSettings->first();

        $response->assertRedirect(route('hospitalSetting.index'));
        $response->assertSessionHas('hospitalSetting.id', $hospitalSetting->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $hospitalSetting = HospitalSetting::factory()->create();

        $response = $this->get(route('hospital-setting.show', $hospitalSetting));

        $response->assertOk();
        $response->assertViewIs('hospitalSetting.show');
        $response->assertViewHas('hospitalSetting');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $hospitalSetting = HospitalSetting::factory()->create();

        $response = $this->get(route('hospital-setting.edit', $hospitalSetting));

        $response->assertOk();
        $response->assertViewIs('hospitalSetting.edit');
        $response->assertViewHas('hospitalSetting');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HospitalSettingController::class,
            'update',
            \App\Http\Requests\HospitalSettingUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $hospitalSetting = HospitalSetting::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('hospital-setting.update', $hospitalSetting), [
            'name' => $name,
        ]);

        $hospitalSetting->refresh();

        $response->assertRedirect(route('hospitalSetting.index'));
        $response->assertSessionHas('hospitalSetting.id', $hospitalSetting->id);

        $this->assertEquals($name, $hospitalSetting->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $hospitalSetting = HospitalSetting::factory()->create();

        $response = $this->delete(route('hospital-setting.destroy', $hospitalSetting));

        $response->assertRedirect(route('hospitalSetting.index'));

        $this->assertModelMissing($hospitalSetting);
    }
}
