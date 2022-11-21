<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchStoreRequest;
use App\Http\Requests\BranchUpdateRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $branches = Branch::all();

        return view('branch.index', compact('branches'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('branch.create');
    }

    /**
     * @param \App\Http\Requests\BranchStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchStoreRequest $request)
    {
        $branch = Branch::create($request->validated());

        $request->session()->flash('branch.id', $branch->id);

        return redirect()->route('branch.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Branch $branch)
    {
        return view('branch.show', compact('branch'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Branch $branch)
    {
        return view('branch.edit', compact('branch'));
    }

    /**
     * @param \App\Http\Requests\BranchUpdateRequest $request
     * @param \App\Models\Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function update(BranchUpdateRequest $request, Branch $branch)
    {
        $branch->update($request->validated());

        $request->session()->flash('branch.id', $branch->id);

        return redirect()->route('branch.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Branch $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Branch $branch)
    {
        $branch->delete();

        return redirect()->route('branch.index');
    }
}
