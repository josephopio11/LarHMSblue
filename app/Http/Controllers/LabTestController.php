<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabTestStoreRequest;
use App\Http\Requests\LabTestUpdateRequest;
use App\Models\LabTest;
use Illuminate\Http\Request;

class LabTestController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $labTests = LabTest::all();

        return view('labTest.index', compact('labTests'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('labTest.create');
    }

    /**
     * @param \App\Http\Requests\LabTestStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LabTestStoreRequest $request)
    {
        $labTest = LabTest::create($request->validated());

        $request->session()->flash('labTest.id', $labTest->id);

        return redirect()->route('labTest.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LabTest $labTest
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, LabTest $labTest)
    {
        return view('labTest.show', compact('labTest'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LabTest $labTest
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, LabTest $labTest)
    {
        return view('labTest.edit', compact('labTest'));
    }

    /**
     * @param \App\Http\Requests\LabTestUpdateRequest $request
     * @param \App\Models\LabTest $labTest
     * @return \Illuminate\Http\Response
     */
    public function update(LabTestUpdateRequest $request, LabTest $labTest)
    {
        $labTest->update($request->validated());

        $request->session()->flash('labTest.id', $labTest->id);

        return redirect()->route('labTest.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LabTest $labTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, LabTest $labTest)
    {
        $labTest->delete();

        return redirect()->route('labTest.index');
    }
}
