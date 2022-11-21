<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillingInvoiceDetailStoreRequest;
use App\Http\Requests\BillingInvoiceDetailUpdateRequest;
use App\Models\BillingInvoiceDetail;
use Illuminate\Http\Request;

class BillingInvoiceDetailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $billingInvoiceDetails = BillingInvoiceDetail::all();

        return view('billingInvoiceDetail.index', compact('billingInvoiceDetails'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('billingInvoiceDetail.create');
    }

    /**
     * @param \App\Http\Requests\BillingInvoiceDetailStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillingInvoiceDetailStoreRequest $request)
    {
        $billingInvoiceDetail = BillingInvoiceDetail::create($request->validated());

        $request->session()->flash('billingInvoiceDetail.id', $billingInvoiceDetail->id);

        return redirect()->route('billingInvoiceDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BillingInvoiceDetail $billingInvoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BillingInvoiceDetail $billingInvoiceDetail)
    {
        return view('billingInvoiceDetail.show', compact('billingInvoiceDetail'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BillingInvoiceDetail $billingInvoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BillingInvoiceDetail $billingInvoiceDetail)
    {
        return view('billingInvoiceDetail.edit', compact('billingInvoiceDetail'));
    }

    /**
     * @param \App\Http\Requests\BillingInvoiceDetailUpdateRequest $request
     * @param \App\Models\BillingInvoiceDetail $billingInvoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function update(BillingInvoiceDetailUpdateRequest $request, BillingInvoiceDetail $billingInvoiceDetail)
    {
        $billingInvoiceDetail->update($request->validated());

        $request->session()->flash('billingInvoiceDetail.id', $billingInvoiceDetail->id);

        return redirect()->route('billingInvoiceDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BillingInvoiceDetail $billingInvoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BillingInvoiceDetail $billingInvoiceDetail)
    {
        $billingInvoiceDetail->delete();

        return redirect()->route('billingInvoiceDetail.index');
    }
}
