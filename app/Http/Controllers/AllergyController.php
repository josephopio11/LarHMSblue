<?php

namespace App\Http\Controllers;

use App\Http\Requests\AllergyStoreRequest;
use App\Http\Requests\AllergyUpdateRequest;
use App\Models\Allergy;
use Illuminate\Http\Request;

class AllergyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allergies = Allergy::all();

        return view('allergy.index', compact('allergies'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('allergy.create');
    }

    /**
     * @param \App\Http\Requests\AllergyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AllergyStoreRequest $request)
    {
        $allergy = Allergy::create($request->validated());

        $request->session()->flash('allergy.id', $allergy->id);

        return redirect()->route('allergy.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Allergy $allergy
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Allergy $allergy)
    {
        return view('allergy.show', compact('allergy'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Allergy $allergy
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Allergy $allergy)
    {
        return view('allergy.edit', compact('allergy'));
    }

    /**
     * @param \App\Http\Requests\AllergyUpdateRequest $request
     * @param \App\Models\Allergy $allergy
     * @return \Illuminate\Http\Response
     */
    public function update(AllergyUpdateRequest $request, Allergy $allergy)
    {
        $allergy->update($request->validated());

        $request->session()->flash('allergy.id', $allergy->id);

        return redirect()->route('allergy.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Allergy $allergy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Allergy $allergy)
    {
        $allergy->delete();

        return redirect()->route('allergy.index');
    }
}
