<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrescriptionStoreRequest;
use App\Http\Requests\PrescriptionUpdateRequest;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prescriptions = Prescription::all();

        return view('prescription.index', compact('prescriptions'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('prescription.create');
    }

    /**
     * @param \App\Http\Requests\PrescriptionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrescriptionStoreRequest $request)
    {
        $prescription = Prescription::create($request->validated());

        $request->session()->flash('prescription.id', $prescription->id);

        return redirect()->route('prescription.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prescription $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Prescription $prescription)
    {
        return view('prescription.show', compact('prescription'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prescription $prescription
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Prescription $prescription)
    {
        return view('prescription.edit', compact('prescription'));
    }

    /**
     * @param \App\Http\Requests\PrescriptionUpdateRequest $request
     * @param \App\Models\Prescription $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(PrescriptionUpdateRequest $request, Prescription $prescription)
    {
        $prescription->update($request->validated());

        $request->session()->flash('prescription.id', $prescription->id);

        return redirect()->route('prescription.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prescription $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Prescription $prescription)
    {
        $prescription->delete();

        return redirect()->route('prescription.index');
    }
}
