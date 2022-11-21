<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\BillingTransaction;
use App\Models\ChequeDetail;
use App\Models\CreatedBy;
use App\Models\UpdatedBy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ChequeDetailController
 */
class ChequeDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $chequeDetails = ChequeDetail::factory()->count(3)->create();

        $response = $this->get(route('cheque-detail.index'));

        $response->assertOk();
        $response->assertViewIs('chequeDetail.index');
        $response->assertViewHas('chequeDetails');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('cheque-detail.create'));

        $response->assertOk();
        $response->assertViewIs('chequeDetail.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ChequeDetailController::class,
            'store',
            \App\Http\Requests\ChequeDetailStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $status = $this->faker->word;
        $billing_transaction = BillingTransaction::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->post(route('cheque-detail.store'), [
            'status' => $status,
            'billing_transaction_id' => $billing_transaction->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $chequeDetails = ChequeDetail::query()
            ->where('status', $status)
            ->where('billing_transaction_id', $billing_transaction->id)
            ->where('created_by_id', $created_by->id)
            ->where('updated_by_id', $updated_by->id)
            ->get();
        $this->assertCount(1, $chequeDetails);
        $chequeDetail = $chequeDetails->first();

        $response->assertRedirect(route('chequeDetail.index'));
        $response->assertSessionHas('chequeDetail.id', $chequeDetail->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $chequeDetail = ChequeDetail::factory()->create();

        $response = $this->get(route('cheque-detail.show', $chequeDetail));

        $response->assertOk();
        $response->assertViewIs('chequeDetail.show');
        $response->assertViewHas('chequeDetail');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $chequeDetail = ChequeDetail::factory()->create();

        $response = $this->get(route('cheque-detail.edit', $chequeDetail));

        $response->assertOk();
        $response->assertViewIs('chequeDetail.edit');
        $response->assertViewHas('chequeDetail');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ChequeDetailController::class,
            'update',
            \App\Http\Requests\ChequeDetailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $chequeDetail = ChequeDetail::factory()->create();
        $status = $this->faker->word;
        $billing_transaction = BillingTransaction::factory()->create();
        $created_by = CreatedBy::factory()->create();
        $updated_by = UpdatedBy::factory()->create();

        $response = $this->put(route('cheque-detail.update', $chequeDetail), [
            'status' => $status,
            'billing_transaction_id' => $billing_transaction->id,
            'created_by_id' => $created_by->id,
            'updated_by_id' => $updated_by->id,
        ]);

        $chequeDetail->refresh();

        $response->assertRedirect(route('chequeDetail.index'));
        $response->assertSessionHas('chequeDetail.id', $chequeDetail->id);

        $this->assertEquals($status, $chequeDetail->status);
        $this->assertEquals($billing_transaction->id, $chequeDetail->billing_transaction_id);
        $this->assertEquals($created_by->id, $chequeDetail->created_by_id);
        $this->assertEquals($updated_by->id, $chequeDetail->updated_by_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $chequeDetail = ChequeDetail::factory()->create();

        $response = $this->delete(route('cheque-detail.destroy', $chequeDetail));

        $response->assertRedirect(route('chequeDetail.index'));

        $this->assertModelMissing($chequeDetail);
    }
}
