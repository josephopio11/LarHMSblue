<?php

namespace App\Http\Controllers;

use App\Http\Requests\NurseStoreRequest;
use App\Http\Requests\NurseUpdateRequest;
use App\Models\Nurse;
use Illuminate\Http\Request;

class NurseController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nurses = Nurse::all();

        return view('nurse.index', compact('nurses'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('nurse.create');
    }

    /**
     * @param \App\Http\Requests\NurseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NurseStoreRequest $request)
    {
        $nurse = Nurse::create($request->validated());

        $request->session()->flash('nurse.id', $nurse->id);

        return redirect()->route('nurse.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Nurse $nurse
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Nurse $nurse)
    {
        return view('nurse.show', compact('nurse'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Nurse $nurse
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Nurse $nurse)
    {
        return view('nurse.edit', compact('nurse'));
    }

    /**
     * @param \App\Http\Requests\NurseUpdateRequest $request
     * @param \App\Models\Nurse $nurse
     * @return \Illuminate\Http\Response
     */
    public function update(NurseUpdateRequest $request, Nurse $nurse)
    {
        $nurse->update($request->validated());

        $request->session()->flash('nurse.id', $nurse->id);

        return redirect()->route('nurse.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Nurse $nurse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Nurse $nurse)
    {
        $nurse->delete();

        return redirect()->route('nurse.index');
    }
}
