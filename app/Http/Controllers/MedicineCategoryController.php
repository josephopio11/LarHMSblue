<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicineCategoryStoreRequest;
use App\Http\Requests\MedicineCategoryUpdateRequest;
use App\Models\MedicineCategory;
use Illuminate\Http\Request;

class MedicineCategoryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medicineCategories = MedicineCategory::all();

        return view('medicineCategory.index', compact('medicineCategories'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('medicineCategory.create');
    }

    /**
     * @param \App\Http\Requests\MedicineCategoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicineCategoryStoreRequest $request)
    {
        $medicineCategory = MedicineCategory::create($request->validated());

        $request->session()->flash('medicineCategory.id', $medicineCategory->id);

        return redirect()->route('medicineCategory.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicineCategory $medicineCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, MedicineCategory $medicineCategory)
    {
        return view('medicineCategory.show', compact('medicineCategory'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicineCategory $medicineCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, MedicineCategory $medicineCategory)
    {
        return view('medicineCategory.edit', compact('medicineCategory'));
    }

    /**
     * @param \App\Http\Requests\MedicineCategoryUpdateRequest $request
     * @param \App\Models\MedicineCategory $medicineCategory
     * @return \Illuminate\Http\Response
     */
    public function update(MedicineCategoryUpdateRequest $request, MedicineCategory $medicineCategory)
    {
        $medicineCategory->update($request->validated());

        $request->session()->flash('medicineCategory.id', $medicineCategory->id);

        return redirect()->route('medicineCategory.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicineCategory $medicineCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MedicineCategory $medicineCategory)
    {
        $medicineCategory->delete();

        return redirect()->route('medicineCategory.index');
    }
}
