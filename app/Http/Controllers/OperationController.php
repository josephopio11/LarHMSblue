<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperationStoreRequest;
use App\Http\Requests\OperationUpdateRequest;
use App\Models\Operation;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $operations = Operation::all();

        return view('operation.index', compact('operations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('operation.create');
    }

    /**
     * @param \App\Http\Requests\OperationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OperationStoreRequest $request)
    {
        $operation = Operation::create($request->validated());

        $request->session()->flash('operation.id', $operation->id);

        return redirect()->route('operation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Operation $operation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Operation $operation)
    {
        return view('operation.show', compact('operation'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Operation $operation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Operation $operation)
    {
        return view('operation.edit', compact('operation'));
    }

    /**
     * @param \App\Http\Requests\OperationUpdateRequest $request
     * @param \App\Models\Operation $operation
     * @return \Illuminate\Http\Response
     */
    public function update(OperationUpdateRequest $request, Operation $operation)
    {
        $operation->update($request->validated());

        $request->session()->flash('operation.id', $operation->id);

        return redirect()->route('operation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Operation $operation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Operation $operation)
    {
        $operation->delete();

        return redirect()->route('operation.index');
    }
}
