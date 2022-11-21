<?php

namespace App\Http\Controllers;

use App\Http\Requests\BedTypeStoreRequest;
use App\Http\Requests\BedTypeUpdateRequest;
use App\Models\BedType;
use Illuminate\Http\Request;

class BedTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bedTypes = BedType::all();

        return view('bedType.index', compact('bedTypes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('bedType.create');
    }

    /**
     * @param \App\Http\Requests\BedTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BedTypeStoreRequest $request)
    {
        $bedType = BedType::create($request->validated());

        $request->session()->flash('bedType.id', $bedType->id);

        return redirect()->route('bedType.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BedType $bedType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BedType $bedType)
    {
        return view('bedType.show', compact('bedType'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BedType $bedType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BedType $bedType)
    {
        return view('bedType.edit', compact('bedType'));
    }

    /**
     * @param \App\Http\Requests\BedTypeUpdateRequest $request
     * @param \App\Models\BedType $bedType
     * @return \Illuminate\Http\Response
     */
    public function update(BedTypeUpdateRequest $request, BedType $bedType)
    {
        $bedType->update($request->validated());

        $request->session()->flash('bedType.id', $bedType->id);

        return redirect()->route('bedType.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BedType $bedType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BedType $bedType)
    {
        $bedType->delete();

        return redirect()->route('bedType.index');
    }
}
