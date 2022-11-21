<?php

namespace App\Http\Controllers;

use App\Http\Requests\WardStoreRequest;
use App\Http\Requests\WardUpdateRequest;
use App\Models\Ward;
use Illuminate\Http\Request;

class WardController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $wards = Ward::all();

        return view('ward.index', compact('wards'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('ward.create');
    }

    /**
     * @param \App\Http\Requests\WardStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WardStoreRequest $request)
    {
        $ward = Ward::create($request->validated());

        $request->session()->flash('ward.id', $ward->id);

        return redirect()->route('ward.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ward $ward
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Ward $ward)
    {
        return view('ward.show', compact('ward'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ward $ward
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Ward $ward)
    {
        return view('ward.edit', compact('ward'));
    }

    /**
     * @param \App\Http\Requests\WardUpdateRequest $request
     * @param \App\Models\Ward $ward
     * @return \Illuminate\Http\Response
     */
    public function update(WardUpdateRequest $request, Ward $ward)
    {
        $ward->update($request->validated());

        $request->session()->flash('ward.id', $ward->id);

        return redirect()->route('ward.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ward $ward
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Ward $ward)
    {
        $ward->delete();

        return redirect()->route('ward.index');
    }
}
