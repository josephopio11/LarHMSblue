<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\BloodBank;
use App\Models\CreatedBy;
use App\Models\Patient;
use App\Models\UpdatedBy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BloodBankController
 */
class BloodBankControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $bloodBanks = BloodBank::factory()->count(3)->create();

        $response = $this->get(route('blood-bank.index'));

        $response->assertOk();
        $response->assertViewIs('bloodBank.index');
        $response->assertViewHas('bloodBanks');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('blood-bank.create'));

        $response->assertOk();
        $response->assertViewIs('bloodBank.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BloodBankController::class,
            'store',
            \App\Http\Requests\BloodBankStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('blood-bank.store'), [
            'status' => $status,
            'patient_id' => $patient->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $bloodBanks = BloodBank::query()
            ->where('status', $status)
            ->where('patient_id', $patient->id)
            ->where('user_id', $user->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $bloodBanks);
        $bloodBank = $bloodBanks->first();

        $response->assertRedirect(route('bloodBank.index'));
        $response->assertSessionHas('bloodBank.id', $bloodBank->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $bloodBank = BloodBank::factory()->create();

        $response = $this->get(route('blood-bank.show', $bloodBank));

        $response->assertOk();
        $response->assertViewIs('bloodBank.show');
        $response->assertViewHas('bloodBank');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $bloodBank = BloodBank::factory()->create();

        $response = $this->get(route('blood-bank.edit', $bloodBank));

        $response->assertOk();
        $response->assertViewIs('bloodBank.edit');
        $response->assertViewHas('bloodBank');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BloodBankController::class,
            'update',
            \App\Http\Requests\BloodBankUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $bloodBank = BloodBank::factory()->create();
        $status = $this->faker->word;
        $patient = Patient::factory()->create();
        $user = User::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('blood-bank.update', $bloodBank), [
            'status' => $status,
            'patient_id' => $patient->id,
            'user_id' => $user->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $bloodBank->refresh();

        $response->assertRedirect(route('bloodBank.index'));
        $response->assertSessionHas('bloodBank.id', $bloodBank->id);

        $this->assertEquals($status, $bloodBank->status);
        $this->assertEquals($patient->id, $bloodBank->patient_id);
        $this->assertEquals($user->id, $bloodBank->user_id);
        $this->assertEquals($created_by->id, $bloodBank->created_by_id);
        $this->assertEquals($updated_by->id, $bloodBank->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $bloodBank = BloodBank::factory()->create();

        $response = $this->delete(route('blood-bank.destroy', $bloodBank));

        $response->assertRedirect(route('bloodBank.index'));

        $this->assertModelMissing($bloodBank);
    }
}
