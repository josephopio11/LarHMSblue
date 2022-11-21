<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientVisitStoreRequest;
use App\Http\Requests\PatientVisitUpdateRequest;
use App\Models\PatientVisit;
use Illuminate\Http\Request;

class PatientVisitController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patientVisits = PatientVisit::all();

        return view('patientVisit.index', compact('patientVisits'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('patientVisit.create');
    }

    /**
     * @param \App\Http\Requests\PatientVisitStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientVisitStoreRequest $request)
    {
        $patientVisit = PatientVisit::create($request->validated());

        $request->session()->flash('patientVisit.id', $patientVisit->id);

        return redirect()->route('patientVisit.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PatientVisit $patientVisit
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PatientVisit $patientVisit)
    {
        return view('patientVisit.show', compact('patientVisit'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PatientVisit $patientVisit
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PatientVisit $patientVisit)
    {
        return view('patientVisit.edit', compact('patientVisit'));
    }

    /**
     * @param \App\Http\Requests\PatientVisitUpdateRequest $request
     * @param \App\Models\PatientVisit $patientVisit
     * @return \Illuminate\Http\Response
     */
    public function update(PatientVisitUpdateRequest $request, PatientVisit $patientVisit)
    {
        $patientVisit->update($request->validated());

        $request->session()->flash('patientVisit.id', $patientVisit->id);

        return redirect()->route('patientVisit.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PatientVisit $patientVisit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PatientVisit $patientVisit)
    {
        $patientVisit->delete();

        return redirect()->route('patientVisit.index');
    }
}
