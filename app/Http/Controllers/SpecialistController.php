<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialistStoreRequest;
use App\Http\Requests\SpecialistUpdateRequest;
use App\Models\Specialist;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $specialists = Specialist::all();

        return view('specialist.index', compact('specialists'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('specialist.create');
    }

    /**
     * @param \App\Http\Requests\SpecialistStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialistStoreRequest $request)
    {
        $specialist = Specialist::create($request->validated());

        $request->session()->flash('specialist.id', $specialist->id);

        return redirect()->route('specialist.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Specialist $specialist
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Specialist $specialist)
    {
        return view('specialist.show', compact('specialist'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Specialist $specialist
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Specialist $specialist)
    {
        return view('specialist.edit', compact('specialist'));
    }

    /**
     * @param \App\Http\Requests\SpecialistUpdateRequest $request
     * @param \App\Models\Specialist $specialist
     * @return \Illuminate\Http\Response
     */
    public function update(SpecialistUpdateRequest $request, Specialist $specialist)
    {
        $specialist->update($request->validated());

        $request->session()->flash('specialist.id', $specialist->id);

        return redirect()->route('specialist.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Specialist $specialist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Specialist $specialist)
    {
        $specialist->delete();

        return redirect()->route('specialist.index');
    }
}
