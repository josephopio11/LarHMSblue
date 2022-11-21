<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresentingComplaintStoreRequest;
use App\Http\Requests\PresentingComplaintUpdateRequest;
use App\Models\PresentingComplaint;
use Illuminate\Http\Request;

class PresentingComplaintController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $presentingComplaints = PresentingComplaint::all();

        return view('presentingComplaint.index', compact('presentingComplaints'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('presentingComplaint.create');
    }

    /**
     * @param \App\Http\Requests\PresentingComplaintStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PresentingComplaintStoreRequest $request)
    {
        $presentingComplaint = PresentingComplaint::create($request->validated());

        $request->session()->flash('presentingComplaint.id', $presentingComplaint->id);

        return redirect()->route('presentingComplaint.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PresentingComplaint $presentingComplaint
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PresentingComplaint $presentingComplaint)
    {
        return view('presentingComplaint.show', compact('presentingComplaint'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PresentingComplaint $presentingComplaint
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PresentingComplaint $presentingComplaint)
    {
        return view('presentingComplaint.edit', compact('presentingComplaint'));
    }

    /**
     * @param \App\Http\Requests\PresentingComplaintUpdateRequest $request
     * @param \App\Models\PresentingComplaint $presentingComplaint
     * @return \Illuminate\Http\Response
     */
    public function update(PresentingComplaintUpdateRequest $request, PresentingComplaint $presentingComplaint)
    {
        $presentingComplaint->update($request->validated());

        $request->session()->flash('presentingComplaint.id', $presentingComplaint->id);

        return redirect()->route('presentingComplaint.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PresentingComplaint $presentingComplaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PresentingComplaint $presentingComplaint)
    {
        $presentingComplaint->delete();

        return redirect()->route('presentingComplaint.index');
    }
}
