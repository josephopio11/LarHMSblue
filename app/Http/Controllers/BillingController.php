<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillingStoreRequest;
use App\Http\Requests\BillingUpdateRequest;
use App\Models\Billing;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $billings = Billing::all();

        return view('billing.index', compact('billings'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('billing.create');
    }

    /**
     * @param \App\Http\Requests\BillingStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillingStoreRequest $request)
    {
        $billing = Billing::create($request->validated());

        $request->session()->flash('billing.id', $billing->id);

        return redirect()->route('billing.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Billing $billing
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Billing $billing)
    {
        return view('billing.show', compact('billing'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Billing $billing
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Billing $billing)
    {
        return view('billing.edit', compact('billing'));
    }

    /**
     * @param \App\Http\Requests\BillingUpdateRequest $request
     * @param \App\Models\Billing $billing
     * @return \Illuminate\Http\Response
     */
    public function update(BillingUpdateRequest $request, Billing $billing)
    {
        $billing->update($request->validated());

        $request->session()->flash('billing.id', $billing->id);

        return redirect()->route('billing.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Billing $billing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Billing $billing)
    {
        $billing->delete();

        return redirect()->route('billing.index');
    }
}
