<?php

namespace App\Http\Controllers;

use App\Http\Requests\BedStoreRequest;
use App\Http\Requests\BedUpdateRequest;
use App\Models\Bed;
use Illuminate\Http\Request;

class BedController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $beds = Bed::all();

        return view('bed.index', compact('beds'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('bed.create');
    }

    /**
     * @param \App\Http\Requests\BedStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BedStoreRequest $request)
    {
        $bed = Bed::create($request->validated());

        $request->session()->flash('bed.id', $bed->id);

        return redirect()->route('bed.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bed $bed
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Bed $bed)
    {
        return view('bed.show', compact('bed'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bed $bed
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Bed $bed)
    {
        return view('bed.edit', compact('bed'));
    }

    /**
     * @param \App\Http\Requests\BedUpdateRequest $request
     * @param \App\Models\Bed $bed
     * @return \Illuminate\Http\Response
     */
    public function update(BedUpdateRequest $request, Bed $bed)
    {
        $bed->update($request->validated());

        $request->session()->flash('bed.id', $bed->id);

        return redirect()->route('bed.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bed $bed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bed $bed)
    {
        $bed->delete();

        return redirect()->route('bed.index');
    }
}
