<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRecordStoreRequest;
use App\Http\Requests\PatientRecordUpdateRequest;
use App\Models\PatientRecord;
use Illuminate\Http\Request;

class PatientRecordController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patientRecords = PatientRecord::all();

        return view('patientRecord.index', compact('patientRecords'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('patientRecord.create');
    }

    /**
     * @param \App\Http\Requests\PatientRecordStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRecordStoreRequest $request)
    {
        $patientRecord = PatientRecord::create($request->validated());

        $request->session()->flash('patientRecord.id', $patientRecord->id);

        return redirect()->route('patientRecord.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PatientRecord $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PatientRecord $patientRecord)
    {
        return view('patientRecord.show', compact('patientRecord'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PatientRecord $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PatientRecord $patientRecord)
    {
        return view('patientRecord.edit', compact('patientRecord'));
    }

    /**
     * @param \App\Http\Requests\PatientRecordUpdateRequest $request
     * @param \App\Models\PatientRecord $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRecordUpdateRequest $request, PatientRecord $patientRecord)
    {
        $patientRecord->update($request->validated());

        $request->session()->flash('patientRecord.id', $patientRecord->id);

        return redirect()->route('patientRecord.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PatientRecord $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PatientRecord $patientRecord)
    {
        $patientRecord->delete();

        return redirect()->route('patientRecord.index');
    }
}
