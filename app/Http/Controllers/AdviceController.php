<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdviceStoreRequest;
use App\Http\Requests\AdviceUpdateRequest;
use App\Models\Advice;
use Illuminate\Http\Request;

class AdviceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $advice = Advice::all();

        return view('advice.index', compact('advice'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('advice.create');
    }

    /**
     * @param \App\Http\Requests\AdviceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdviceStoreRequest $request)
    {
        $advice = Advice::create($request->validated());

        $request->session()->flash('advice.id', $advice->id);

        return redirect()->route('advice.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Advice $advice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Advice $advice)
    {
        return view('advice.show', compact('advice'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Advice $advice
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Advice $advice)
    {
        return view('advice.edit', compact('advice'));
    }

    /**
     * @param \App\Http\Requests\AdviceUpdateRequest $request
     * @param \App\Models\Advice $advice
     * @return \Illuminate\Http\Response
     */
    public function update(AdviceUpdateRequest $request, Advice $advice)
    {
        $advice->update($request->validated());

        $request->session()->flash('advice.id', $advice->id);

        return redirect()->route('advice.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Advice $advice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Advice $advice)
    {
        $advice->delete();

        return redirect()->route('advice.index');
    }
}
