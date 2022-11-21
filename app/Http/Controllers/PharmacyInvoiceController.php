<?php

namespace App\Http\Controllers;

use App\Http\Requests\PharmacyInvoiceStoreRequest;
use App\Http\Requests\PharmacyInvoiceUpdateRequest;
use App\Models\PharmacyInvoice;
use Illuminate\Http\Request;

class PharmacyInvoiceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pharmacyInvoices = PharmacyInvoice::all();

        return view('pharmacyInvoice.index', compact('pharmacyInvoices'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pharmacyInvoice.create');
    }

    /**
     * @param \App\Http\Requests\PharmacyInvoiceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PharmacyInvoiceStoreRequest $request)
    {
        $pharmacyInvoice = PharmacyInvoice::create($request->validated());

        $request->session()->flash('pharmacyInvoice.id', $pharmacyInvoice->id);

        return redirect()->route('pharmacyInvoice.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PharmacyInvoice $pharmacyInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PharmacyInvoice $pharmacyInvoice)
    {
        return view('pharmacyInvoice.show', compact('pharmacyInvoice'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PharmacyInvoice $pharmacyInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PharmacyInvoice $pharmacyInvoice)
    {
        return view('pharmacyInvoice.edit', compact('pharmacyInvoice'));
    }

    /**
     * @param \App\Http\Requests\PharmacyInvoiceUpdateRequest $request
     * @param \App\Models\PharmacyInvoice $pharmacyInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(PharmacyInvoiceUpdateRequest $request, PharmacyInvoice $pharmacyInvoice)
    {
        $pharmacyInvoice->update($request->validated());

        $request->session()->flash('pharmacyInvoice.id', $pharmacyInvoice->id);

        return redirect()->route('pharmacyInvoice.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PharmacyInvoice $pharmacyInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PharmacyInvoice $pharmacyInvoice)
    {
        $pharmacyInvoice->delete();

        return redirect()->route('pharmacyInvoice.index');
    }
}
