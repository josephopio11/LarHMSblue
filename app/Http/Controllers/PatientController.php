<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patients = Patient::all();

        return view('patient.index', compact('patients'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('patient.create');
    }

    /**
     * @param \App\Http\Requests\PatientStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientStoreRequest $request)
    {
        $patient = Patient::create($request->validated());

        $request->session()->flash('patient.id', $patient->id);

        return redirect()->route('patient.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Patient $patient)
    {
        return view('patient.show', compact('patient'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Patient $patient)
    {
        return view('patient.edit', compact('patient'));
    }

    /**
     * @param \App\Http\Requests\PatientUpdateRequest $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function update(PatientUpdateRequest $request, Patient $patient)
    {
        $patient->update($request->validated());

        $request->session()->flash('patient.id', $patient->id);

        return redirect()->route('patient.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patient.index');
    }
}
