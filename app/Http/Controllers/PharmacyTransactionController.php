<?php

namespace App\Http\Controllers;

use App\Http\Requests\PharmacyTransactionStoreRequest;
use App\Http\Requests\PharmacyTransactionUpdateRequest;
use App\Models\PharmacyTransaction;
use Illuminate\Http\Request;

class PharmacyTransactionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pharmacyTransactions = PharmacyTransaction::all();

        return view('pharmacyTransaction.index', compact('pharmacyTransactions'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pharmacyTransaction.create');
    }

    /**
     * @param \App\Http\Requests\PharmacyTransactionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PharmacyTransactionStoreRequest $request)
    {
        $pharmacyTransaction = PharmacyTransaction::create($request->validated());

        $request->session()->flash('pharmacyTransaction.id', $pharmacyTransaction->id);

        return redirect()->route('pharmacyTransaction.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PharmacyTransaction $pharmacyTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PharmacyTransaction $pharmacyTransaction)
    {
        return view('pharmacyTransaction.show', compact('pharmacyTransaction'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PharmacyTransaction $pharmacyTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PharmacyTransaction $pharmacyTransaction)
    {
        return view('pharmacyTransaction.edit', compact('pharmacyTransaction'));
    }

    /**
     * @param \App\Http\Requests\PharmacyTransactionUpdateRequest $request
     * @param \App\Models\PharmacyTransaction $pharmacyTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(PharmacyTransactionUpdateRequest $request, PharmacyTransaction $pharmacyTransaction)
    {
        $pharmacyTransaction->update($request->validated());

        $request->session()->flash('pharmacyTransaction.id', $pharmacyTransaction->id);

        return redirect()->route('pharmacyTransaction.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PharmacyTransaction $pharmacyTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PharmacyTransaction $pharmacyTransaction)
    {
        $pharmacyTransaction->delete();

        return redirect()->route('pharmacyTransaction.index');
    }
}
