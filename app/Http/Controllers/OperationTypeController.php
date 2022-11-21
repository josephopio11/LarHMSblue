<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperationTypeStoreRequest;
use App\Http\Requests\OperationTypeUpdateRequest;
use App\Models\OperationType;
use Illuminate\Http\Request;

class OperationTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $operationTypes = OperationType::all();

        return view('operationType.index', compact('operationTypes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('operationType.create');
    }

    /**
     * @param \App\Http\Requests\OperationTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OperationTypeStoreRequest $request)
    {
        $operationType = OperationType::create($request->validated());

        $request->session()->flash('operationType.id', $operationType->id);

        return redirect()->route('operationType.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OperationType $operationType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OperationType $operationType)
    {
        return view('operationType.show', compact('operationType'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OperationType $operationType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, OperationType $operationType)
    {
        return view('operationType.edit', compact('operationType'));
    }

    /**
     * @param \App\Http\Requests\OperationTypeUpdateRequest $request
     * @param \App\Models\OperationType $operationType
     * @return \Illuminate\Http\Response
     */
    public function update(OperationTypeUpdateRequest $request, OperationType $operationType)
    {
        $operationType->update($request->validated());

        $request->session()->flash('operationType.id', $operationType->id);

        return redirect()->route('operationType.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OperationType $operationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OperationType $operationType)
    {
        $operationType->delete();

        return redirect()->route('operationType.index');
    }
}
