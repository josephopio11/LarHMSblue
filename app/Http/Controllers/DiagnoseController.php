<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiagnoseStoreRequest;
use App\Http\Requests\DiagnoseUpdateRequest;
use App\Models\Diagnose;
use Illuminate\Http\Request;

class DiagnoseController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $diagnoses = Diagnose::all();

        return view('diagnose.index', compact('diagnoses'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('diagnose.create');
    }

    /**
     * @param \App\Http\Requests\DiagnoseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiagnoseStoreRequest $request)
    {
        $diagnose = Diagnose::create($request->validated());

        $request->session()->flash('diagnose.id', $diagnose->id);

        return redirect()->route('diagnose.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Diagnose $diagnose
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Diagnose $diagnose)
    {
        return view('diagnose.show', compact('diagnose'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Diagnose $diagnose
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Diagnose $diagnose)
    {
        return view('diagnose.edit', compact('diagnose'));
    }

    /**
     * @param \App\Http\Requests\DiagnoseUpdateRequest $request
     * @param \App\Models\Diagnose $diagnose
     * @return \Illuminate\Http\Response
     */
    public function update(DiagnoseUpdateRequest $request, Diagnose $diagnose)
    {
        $diagnose->update($request->validated());

        $request->session()->flash('diagnose.id', $diagnose->id);

        return redirect()->route('diagnose.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Diagnose $diagnose
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Diagnose $diagnose)
    {
        $diagnose->delete();

        return redirect()->route('diagnose.index');
    }
}
