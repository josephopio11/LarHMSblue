<?php

namespace App\Http\Controllers;

use App\Http\Requests\BloodStockStoreRequest;
use App\Http\Requests\BloodStockUpdateRequest;
use App\Models\BloodStock;
use Illuminate\Http\Request;

class BloodStockController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bloodStocks = BloodStock::all();

        return view('bloodStock.index', compact('bloodStocks'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('bloodStock.create');
    }

    /**
     * @param \App\Http\Requests\BloodStockStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BloodStockStoreRequest $request)
    {
        $bloodStock = BloodStock::create($request->validated());

        $request->session()->flash('bloodStock.id', $bloodStock->id);

        return redirect()->route('bloodStock.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodStock $bloodStock
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BloodStock $bloodStock)
    {
        return view('bloodStock.show', compact('bloodStock'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodStock $bloodStock
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BloodStock $bloodStock)
    {
        return view('bloodStock.edit', compact('bloodStock'));
    }

    /**
     * @param \App\Http\Requests\BloodStockUpdateRequest $request
     * @param \App\Models\BloodStock $bloodStock
     * @return \Illuminate\Http\Response
     */
    public function update(BloodStockUpdateRequest $request, BloodStock $bloodStock)
    {
        $bloodStock->update($request->validated());

        $request->session()->flash('bloodStock.id', $bloodStock->id);

        return redirect()->route('bloodStock.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodStock $bloodStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BloodStock $bloodStock)
    {
        $bloodStock->delete();

        return redirect()->route('bloodStock.index');
    }
}
