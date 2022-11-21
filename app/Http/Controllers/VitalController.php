<?php

namespace App\Http\Controllers;

use App\Http\Requests\VitalStoreRequest;
use App\Http\Requests\VitalUpdateRequest;
use App\Models\Vital;
use Illuminate\Http\Request;

class VitalController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vitals = Vital::all();

        return view('vital.index', compact('vitals'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('vital.create');
    }

    /**
     * @param \App\Http\Requests\VitalStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VitalStoreRequest $request)
    {
        $vital = Vital::create($request->validated());

        $request->session()->flash('vital.id', $vital->id);

        return redirect()->route('vital.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Vital $vital
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Vital $vital)
    {
        return view('vital.show', compact('vital'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Vital $vital
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Vital $vital)
    {
        return view('vital.edit', compact('vital'));
    }

    /**
     * @param \App\Http\Requests\VitalUpdateRequest $request
     * @param \App\Models\Vital $vital
     * @return \Illuminate\Http\Response
     */
    public function update(VitalUpdateRequest $request, Vital $vital)
    {
        $vital->update($request->validated());

        $request->session()->flash('vital.id', $vital->id);

        return redirect()->route('vital.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Vital $vital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Vital $vital)
    {
        $vital->delete();

        return redirect()->route('vital.index');
    }
}
