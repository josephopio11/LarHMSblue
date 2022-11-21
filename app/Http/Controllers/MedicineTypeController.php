<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicineTypeStoreRequest;
use App\Http\Requests\MedicineTypeUpdateRequest;
use App\Models\MedicineType;
use Illuminate\Http\Request;

class MedicineTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medicineTypes = MedicineType::all();

        return view('medicineType.index', compact('medicineTypes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('medicineType.create');
    }

    /**
     * @param \App\Http\Requests\MedicineTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicineTypeStoreRequest $request)
    {
        $medicineType = MedicineType::create($request->validated());

        $request->session()->flash('medicineType.id', $medicineType->id);

        return redirect()->route('medicineType.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicineType $medicineType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, MedicineType $medicineType)
    {
        return view('medicineType.show', compact('medicineType'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicineType $medicineType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, MedicineType $medicineType)
    {
        return view('medicineType.edit', compact('medicineType'));
    }

    /**
     * @param \App\Http\Requests\MedicineTypeUpdateRequest $request
     * @param \App\Models\MedicineType $medicineType
     * @return \Illuminate\Http\Response
     */
    public function update(MedicineTypeUpdateRequest $request, MedicineType $medicineType)
    {
        $medicineType->update($request->validated());

        $request->session()->flash('medicineType.id', $medicineType->id);

        return redirect()->route('medicineType.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicineType $medicineType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MedicineType $medicineType)
    {
        $medicineType->delete();

        return redirect()->route('medicineType.index');
    }
}
