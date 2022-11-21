<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImmunisationStoreRequest;
use App\Http\Requests\ImmunisationUpdateRequest;
use App\Models\Immunisation;
use Illuminate\Http\Request;

class ImmunisationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $immunisations = Immunisation::all();

        return view('immunisation.index', compact('immunisations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('immunisation.create');
    }

    /**
     * @param \App\Http\Requests\ImmunisationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImmunisationStoreRequest $request)
    {
        $immunisation = Immunisation::create($request->validated());

        $request->session()->flash('immunisation.id', $immunisation->id);

        return redirect()->route('immunisation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Immunisation $immunisation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Immunisation $immunisation)
    {
        return view('immunisation.show', compact('immunisation'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Immunisation $immunisation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Immunisation $immunisation)
    {
        return view('immunisation.edit', compact('immunisation'));
    }

    /**
     * @param \App\Http\Requests\ImmunisationUpdateRequest $request
     * @param \App\Models\Immunisation $immunisation
     * @return \Illuminate\Http\Response
     */
    public function update(ImmunisationUpdateRequest $request, Immunisation $immunisation)
    {
        $immunisation->update($request->validated());

        $request->session()->flash('immunisation.id', $immunisation->id);

        return redirect()->route('immunisation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Immunisation $immunisation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Immunisation $immunisation)
    {
        $immunisation->delete();

        return redirect()->route('immunisation.index');
    }
}
