<?php

namespace App\Http\Controllers;

use App\Http\Requests\PharmacyStoreRequest;
use App\Http\Requests\PharmacyUpdateRequest;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pharmacies = Pharmacy::all();

        return view('pharmacy.index', compact('pharmacies'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pharmacy.create');
    }

    /**
     * @param \App\Http\Requests\PharmacyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PharmacyStoreRequest $request)
    {
        $pharmacy = Pharmacy::create($request->validated());

        $request->session()->flash('pharmacy.id', $pharmacy->id);

        return redirect()->route('pharmacy.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pharmacy $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Pharmacy $pharmacy)
    {
        return view('pharmacy.show', compact('pharmacy'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pharmacy $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pharmacy $pharmacy)
    {
        return view('pharmacy.edit', compact('pharmacy'));
    }

    /**
     * @param \App\Http\Requests\PharmacyUpdateRequest $request
     * @param \App\Models\Pharmacy $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function update(PharmacyUpdateRequest $request, Pharmacy $pharmacy)
    {
        $pharmacy->update($request->validated());

        $request->session()->flash('pharmacy.id', $pharmacy->id);

        return redirect()->route('pharmacy.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pharmacy $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pharmacy $pharmacy)
    {
        $pharmacy->delete();

        return redirect()->route('pharmacy.index');
    }
}
