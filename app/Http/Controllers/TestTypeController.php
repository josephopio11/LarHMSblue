<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestTypeStoreRequest;
use App\Http\Requests\TestTypeUpdateRequest;
use App\Models\TestType;
use Illuminate\Http\Request;

class TestTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $testTypes = TestType::all();

        return view('testType.index', compact('testTypes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('testType.create');
    }

    /**
     * @param \App\Http\Requests\TestTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestTypeStoreRequest $request)
    {
        $testType = TestType::create($request->validated());

        $request->session()->flash('testType.id', $testType->id);

        return redirect()->route('testType.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TestType $testType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TestType $testType)
    {
        return view('testType.show', compact('testType'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TestType $testType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, TestType $testType)
    {
        return view('testType.edit', compact('testType'));
    }

    /**
     * @param \App\Http\Requests\TestTypeUpdateRequest $request
     * @param \App\Models\TestType $testType
     * @return \Illuminate\Http\Response
     */
    public function update(TestTypeUpdateRequest $request, TestType $testType)
    {
        $testType->update($request->validated());

        $request->session()->flash('testType.id', $testType->id);

        return redirect()->route('testType.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TestType $testType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TestType $testType)
    {
        $testType->delete();

        return redirect()->route('testType.index');
    }
}
