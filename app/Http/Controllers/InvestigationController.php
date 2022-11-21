<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestigationStoreRequest;
use App\Http\Requests\InvestigationUpdateRequest;
use App\Models\Investigation;
use Illuminate\Http\Request;

class InvestigationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $investigations = Investigation::all();

        return view('investigation.index', compact('investigations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('investigation.create');
    }

    /**
     * @param \App\Http\Requests\InvestigationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvestigationStoreRequest $request)
    {
        $investigation = Investigation::create($request->validated());

        $request->session()->flash('investigation.id', $investigation->id);

        return redirect()->route('investigation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Investigation $investigation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Investigation $investigation)
    {
        return view('investigation.show', compact('investigation'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Investigation $investigation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Investigation $investigation)
    {
        return view('investigation.edit', compact('investigation'));
    }

    /**
     * @param \App\Http\Requests\InvestigationUpdateRequest $request
     * @param \App\Models\Investigation $investigation
     * @return \Illuminate\Http\Response
     */
    public function update(InvestigationUpdateRequest $request, Investigation $investigation)
    {
        $investigation->update($request->validated());

        $request->session()->flash('investigation.id', $investigation->id);

        return redirect()->route('investigation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Investigation $investigation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Investigation $investigation)
    {
        $investigation->delete();

        return redirect()->route('investigation.index');
    }
}
