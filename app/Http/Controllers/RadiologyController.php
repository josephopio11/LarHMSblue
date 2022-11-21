<?php

namespace App\Http\Controllers;

use App\Http\Requests\RadiologyStoreRequest;
use App\Http\Requests\RadiologyUpdateRequest;
use App\Models\Radiology;
use Illuminate\Http\Request;

class RadiologyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $radiologies = Radiology::all();

        return view('radiology.index', compact('radiologies'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('radiology.create');
    }

    /**
     * @param \App\Http\Requests\RadiologyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RadiologyStoreRequest $request)
    {
        $radiology = Radiology::create($request->validated());

        $request->session()->flash('radiology.id', $radiology->id);

        return redirect()->route('radiology.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Radiology $radiology
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Radiology $radiology)
    {
        return view('radiology.show', compact('radiology'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Radiology $radiology
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Radiology $radiology)
    {
        return view('radiology.edit', compact('radiology'));
    }

    /**
     * @param \App\Http\Requests\RadiologyUpdateRequest $request
     * @param \App\Models\Radiology $radiology
     * @return \Illuminate\Http\Response
     */
    public function update(RadiologyUpdateRequest $request, Radiology $radiology)
    {
        $radiology->update($request->validated());

        $request->session()->flash('radiology.id', $radiology->id);

        return redirect()->route('radiology.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Radiology $radiology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Radiology $radiology)
    {
        $radiology->delete();

        return redirect()->route('radiology.index');
    }
}
