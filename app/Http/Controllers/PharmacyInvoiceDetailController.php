<?php

namespace App\Http\Controllers;

use App\Http\Requests\PharmacyInvoiceDetailStoreRequest;
use App\Http\Requests\PharmacyInvoiceDetailUpdateRequest;
use App\Models\PharmacyInvoiceDetail;
use Illuminate\Http\Request;

class PharmacyInvoiceDetailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pharmacyInvoiceDetails = PharmacyInvoiceDetail::all();

        return view('pharmacyInvoiceDetail.index', compact('pharmacyInvoiceDetails'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pharmacyInvoiceDetail.create');
    }

    /**
     * @param \App\Http\Requests\PharmacyInvoiceDetailStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PharmacyInvoiceDetailStoreRequest $request)
    {
        $pharmacyInvoiceDetail = PharmacyInvoiceDetail::create($request->validated());

        $request->session()->flash('pharmacyInvoiceDetail.id', $pharmacyInvoiceDetail->id);

        return redirect()->route('pharmacyInvoiceDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PharmacyInvoiceDetail $pharmacyInvoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PharmacyInvoiceDetail $pharmacyInvoiceDetail)
    {
        return view('pharmacyInvoiceDetail.show', compact('pharmacyInvoiceDetail'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PharmacyInvoiceDetail $pharmacyInvoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PharmacyInvoiceDetail $pharmacyInvoiceDetail)
    {
        return view('pharmacyInvoiceDetail.edit', compact('pharmacyInvoiceDetail'));
    }

    /**
     * @param \App\Http\Requests\PharmacyInvoiceDetailUpdateRequest $request
     * @param \App\Models\PharmacyInvoiceDetail $pharmacyInvoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function update(PharmacyInvoiceDetailUpdateRequest $request, PharmacyInvoiceDetail $pharmacyInvoiceDetail)
    {
        $pharmacyInvoiceDetail->update($request->validated());

        $request->session()->flash('pharmacyInvoiceDetail.id', $pharmacyInvoiceDetail->id);

        return redirect()->route('pharmacyInvoiceDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PharmacyInvoiceDetail $pharmacyInvoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PharmacyInvoiceDetail $pharmacyInvoiceDetail)
    {
        $pharmacyInvoiceDetail->delete();

        return redirect()->route('pharmacyInvoiceDetail.index');
    }
}
