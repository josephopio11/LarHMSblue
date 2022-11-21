<?php

namespace App\Http\Controllers;

use App\Http\Requests\BloodRequestStoreRequest;
use App\Http\Requests\BloodRequestUpdateRequest;
use App\Models\BloodRequest;
use Illuminate\Http\Request;

class BloodRequestController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bloodRequests = BloodRequest::all();

        return view('bloodRequest.index', compact('bloodRequests'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('bloodRequest.create');
    }

    /**
     * @param \App\Http\Requests\BloodRequestStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BloodRequestStoreRequest $request)
    {
        $bloodRequest = BloodRequest::create($request->validated());

        $request->session()->flash('bloodRequest.id', $bloodRequest->id);

        return redirect()->route('bloodRequest.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodRequest $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BloodRequest $bloodRequest)
    {
        return view('bloodRequest.show', compact('bloodRequest'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodRequest $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BloodRequest $bloodRequest)
    {
        return view('bloodRequest.edit', compact('bloodRequest'));
    }

    /**
     * @param \App\Http\Requests\BloodRequestUpdateRequest $request
     * @param \App\Models\BloodRequest $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function update(BloodRequestUpdateRequest $request, BloodRequest $bloodRequest)
    {
        $bloodRequest->update($request->validated());

        $request->session()->flash('bloodRequest.id', $bloodRequest->id);

        return redirect()->route('bloodRequest.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodRequest $bloodRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BloodRequest $bloodRequest)
    {
        $bloodRequest->delete();

        return redirect()->route('bloodRequest.index');
    }
}
