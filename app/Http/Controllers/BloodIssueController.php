<?php

namespace App\Http\Controllers;

use App\Http\Requests\BloodIssueStoreRequest;
use App\Http\Requests\BloodIssueUpdateRequest;
use App\Models\BloodIssue;
use Illuminate\Http\Request;

class BloodIssueController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bloodIssues = BloodIssue::all();

        return view('bloodIssue.index', compact('bloodIssues'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('bloodIssue.create');
    }

    /**
     * @param \App\Http\Requests\BloodIssueStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BloodIssueStoreRequest $request)
    {
        $bloodIssue = BloodIssue::create($request->validated());

        $request->session()->flash('bloodIssue.id', $bloodIssue->id);

        return redirect()->route('bloodIssue.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodIssue $bloodIssue
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BloodIssue $bloodIssue)
    {
        return view('bloodIssue.show', compact('bloodIssue'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodIssue $bloodIssue
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BloodIssue $bloodIssue)
    {
        return view('bloodIssue.edit', compact('bloodIssue'));
    }

    /**
     * @param \App\Http\Requests\BloodIssueUpdateRequest $request
     * @param \App\Models\BloodIssue $bloodIssue
     * @return \Illuminate\Http\Response
     */
    public function update(BloodIssueUpdateRequest $request, BloodIssue $bloodIssue)
    {
        $bloodIssue->update($request->validated());

        $request->session()->flash('bloodIssue.id', $bloodIssue->id);

        return redirect()->route('bloodIssue.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodIssue $bloodIssue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BloodIssue $bloodIssue)
    {
        $bloodIssue->delete();

        return redirect()->route('bloodIssue.index');
    }
}
