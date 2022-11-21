<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicineStoreRequest;
use App\Http\Requests\MedicineUpdateRequest;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medicines = Medicine::all();

        return view('medicine.index', compact('medicines'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('medicine.create');
    }

    /**
     * @param \App\Http\Requests\MedicineStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicineStoreRequest $request)
    {
        $medicine = Medicine::create($request->validated());

        $request->session()->flash('medicine.id', $medicine->id);

        return redirect()->route('medicine.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Medicine $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Medicine $medicine)
    {
        return view('medicine.show', compact('medicine'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Medicine $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Medicine $medicine)
    {
        return view('medicine.edit', compact('medicine'));
    }

    /**
     * @param \App\Http\Requests\MedicineUpdateRequest $request
     * @param \App\Models\Medicine $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(MedicineUpdateRequest $request, Medicine $medicine)
    {
        $medicine->update($request->validated());

        $request->session()->flash('medicine.id', $medicine->id);

        return redirect()->route('medicine.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Medicine $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Medicine $medicine)
    {
        $medicine->delete();

        return redirect()->route('medicine.index');
    }
}
