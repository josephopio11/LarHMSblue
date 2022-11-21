<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillingTransactionStoreRequest;
use App\Http\Requests\BillingTransactionUpdateRequest;
use App\Models\BillingTransaction;
use Illuminate\Http\Request;

class BillingTransactionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $billingTransactions = BillingTransaction::all();

        return view('billingTransaction.index', compact('billingTransactions'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('billingTransaction.create');
    }

    /**
     * @param \App\Http\Requests\BillingTransactionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillingTransactionStoreRequest $request)
    {
        $billingTransaction = BillingTransaction::create($request->validated());

        $request->session()->flash('billingTransaction.id', $billingTransaction->id);

        return redirect()->route('billingTransaction.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BillingTransaction $billingTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BillingTransaction $billingTransaction)
    {
        return view('billingTransaction.show', compact('billingTransaction'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BillingTransaction $billingTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BillingTransaction $billingTransaction)
    {
        return view('billingTransaction.edit', compact('billingTransaction'));
    }

    /**
     * @param \App\Http\Requests\BillingTransactionUpdateRequest $request
     * @param \App\Models\BillingTransaction $billingTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(BillingTransactionUpdateRequest $request, BillingTransaction $billingTransaction)
    {
        $billingTransaction->update($request->validated());

        $request->session()->flash('billingTransaction.id', $billingTransaction->id);

        return redirect()->route('billingTransaction.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BillingTransaction $billingTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BillingTransaction $billingTransaction)
    {
        $billingTransaction->delete();

        return redirect()->route('billingTransaction.index');
    }
}
