<?php

namespace App\Http\Controllers;

use App\Http\Requests\SampleCollectionStoreRequest;
use App\Http\Requests\SampleCollectionUpdateRequest;
use App\Models\SampleCollection;
use Illuminate\Http\Request;

class SampleCollectionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sampleCollections = SampleCollection::all();

        return view('sampleCollection.index', compact('sampleCollections'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('sampleCollection.create');
    }

    /**
     * @param \App\Http\Requests\SampleCollectionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SampleCollectionStoreRequest $request)
    {
        $sampleCollection = SampleCollection::create($request->validated());

        $request->session()->flash('sampleCollection.id', $sampleCollection->id);

        return redirect()->route('sampleCollection.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SampleCollection $sampleCollection
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SampleCollection $sampleCollection)
    {
        return view('sampleCollection.show', compact('sampleCollection'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SampleCollection $sampleCollection
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, SampleCollection $sampleCollection)
    {
        return view('sampleCollection.edit', compact('sampleCollection'));
    }

    /**
     * @param \App\Http\Requests\SampleCollectionUpdateRequest $request
     * @param \App\Models\SampleCollection $sampleCollection
     * @return \Illuminate\Http\Response
     */
    public function update(SampleCollectionUpdateRequest $request, SampleCollection $sampleCollection)
    {
        $sampleCollection->update($request->validated());

        $request->session()->flash('sampleCollection.id', $sampleCollection->id);

        return redirect()->route('sampleCollection.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SampleCollection $sampleCollection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SampleCollection $sampleCollection)
    {
        $sampleCollection->delete();

        return redirect()->route('sampleCollection.index');
    }
}
