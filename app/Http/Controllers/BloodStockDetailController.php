<?php

namespace App\Http\Controllers;

use App\Http\Requests\BloodStockDetailStoreRequest;
use App\Http\Requests\BloodStockDetailUpdateRequest;
use App\Models\BloodStockDetail;
use Illuminate\Http\Request;

class BloodStockDetailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bloodStockDetails = BloodStockDetail::all();

        return view('bloodStockDetail.index', compact('bloodStockDetails'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('bloodStockDetail.create');
    }

    /**
     * @param \App\Http\Requests\BloodStockDetailStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BloodStockDetailStoreRequest $request)
    {
        $bloodStockDetail = BloodStockDetail::create($request->validated());

        $request->session()->flash('bloodStockDetail.id', $bloodStockDetail->id);

        return redirect()->route('bloodStockDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodStockDetail $bloodStockDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BloodStockDetail $bloodStockDetail)
    {
        return view('bloodStockDetail.show', compact('bloodStockDetail'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodStockDetail $bloodStockDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BloodStockDetail $bloodStockDetail)
    {
        return view('bloodStockDetail.edit', compact('bloodStockDetail'));
    }

    /**
     * @param \App\Http\Requests\BloodStockDetailUpdateRequest $request
     * @param \App\Models\BloodStockDetail $bloodStockDetail
     * @return \Illuminate\Http\Response
     */
    public function update(BloodStockDetailUpdateRequest $request, BloodStockDetail $bloodStockDetail)
    {
        $bloodStockDetail->update($request->validated());

        $request->session()->flash('bloodStockDetail.id', $bloodStockDetail->id);

        return redirect()->route('bloodStockDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodStockDetail $bloodStockDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BloodStockDetail $bloodStockDetail)
    {
        $bloodStockDetail->delete();

        return redirect()->route('bloodStockDetail.index');
    }
}
