<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorStoreRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $doctors = Doctor::all();

        return view('doctor.index', compact('doctors'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('doctor.create');
    }

    /**
     * @param \App\Http\Requests\DoctorStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorStoreRequest $request)
    {
        $doctor = Doctor::create($request->validated());

        $request->session()->flash('doctor.id', $doctor->id);

        return redirect()->route('doctor.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Doctor $doctor)
    {
        return view('doctor.show', compact('doctor'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Doctor $doctor)
    {
        return view('doctor.edit', compact('doctor'));
    }

    /**
     * @param \App\Http\Requests\DoctorUpdateRequest $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorUpdateRequest $request, Doctor $doctor)
    {
        $doctor->update($request->validated());

        $request->session()->flash('doctor.id', $doctor->id);

        return redirect()->route('doctor.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('doctor.index');
    }
}
