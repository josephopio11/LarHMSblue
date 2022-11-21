<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillingInvoiceStoreRequest;
use App\Http\Requests\BillingInvoiceUpdateRequest;
use App\Models\BillingInvoice;
use Illuminate\Http\Request;

class BillingInvoiceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $billingInvoices = BillingInvoice::all();

        return view('billingInvoice.index', compact('billingInvoices'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('billingInvoice.create');
    }

    /**
     * @param \App\Http\Requests\BillingInvoiceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillingInvoiceStoreRequest $request)
    {
        $billingInvoice = BillingInvoice::create($request->validated());

        $request->session()->flash('billingInvoice.id', $billingInvoice->id);

        return redirect()->route('billingInvoice.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BillingInvoice $billingInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BillingInvoice $billingInvoice)
    {
        return view('billingInvoice.show', compact('billingInvoice'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BillingInvoice $billingInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BillingInvoice $billingInvoice)
    {
        return view('billingInvoice.edit', compact('billingInvoice'));
    }

    /**
     * @param \App\Http\Requests\BillingInvoiceUpdateRequest $request
     * @param \App\Models\BillingInvoice $billingInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(BillingInvoiceUpdateRequest $request, BillingInvoice $billingInvoice)
    {
        $billingInvoice->update($request->validated());

        $request->session()->flash('billingInvoice.id', $billingInvoice->id);

        return redirect()->route('billingInvoice.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BillingInvoice $billingInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BillingInvoice $billingInvoice)
    {
        $billingInvoice->delete();

        return redirect()->route('billingInvoice.index');
    }
}
