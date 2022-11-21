<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalCertificateStoreRequest;
use App\Http\Requests\MedicalCertificateUpdateRequest;
use App\Models\MedicalCertificate;
use Illuminate\Http\Request;

class MedicalCertificateController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medicalCertificates = MedicalCertificate::all();

        return view('medicalCertificate.index', compact('medicalCertificates'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('medicalCertificate.create');
    }

    /**
     * @param \App\Http\Requests\MedicalCertificateStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicalCertificateStoreRequest $request)
    {
        $medicalCertificate = MedicalCertificate::create($request->validated());

        $request->session()->flash('medicalCertificate.id', $medicalCertificate->id);

        return redirect()->route('medicalCertificate.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicalCertificate $medicalCertificate
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, MedicalCertificate $medicalCertificate)
    {
        return view('medicalCertificate.show', compact('medicalCertificate'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicalCertificate $medicalCertificate
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, MedicalCertificate $medicalCertificate)
    {
        return view('medicalCertificate.edit', compact('medicalCertificate'));
    }

    /**
     * @param \App\Http\Requests\MedicalCertificateUpdateRequest $request
     * @param \App\Models\MedicalCertificate $medicalCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(MedicalCertificateUpdateRequest $request, MedicalCertificate $medicalCertificate)
    {
        $medicalCertificate->update($request->validated());

        $request->session()->flash('medicalCertificate.id', $medicalCertificate->id);

        return redirect()->route('medicalCertificate.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicalCertificate $medicalCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MedicalCertificate $medicalCertificate)
    {
        $medicalCertificate->delete();

        return redirect()->route('medicalCertificate.index');
    }
}
