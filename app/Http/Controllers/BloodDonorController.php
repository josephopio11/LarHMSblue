<?php

namespace App\Http\Controllers;

use App\Http\Requests\BloodDonorStoreRequest;
use App\Http\Requests\BloodDonorUpdateRequest;
use App\Models\BloodDonor;
use Illuminate\Http\Request;

class BloodDonorController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bloodDonors = BloodDonor::all();

        return view('bloodDonor.index', compact('bloodDonors'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('bloodDonor.create');
    }

    /**
     * @param \App\Http\Requests\BloodDonorStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BloodDonorStoreRequest $request)
    {
        $bloodDonor = BloodDonor::create($request->validated());

        $request->session()->flash('bloodDonor.id', $bloodDonor->id);

        return redirect()->route('bloodDonor.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodDonor $bloodDonor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BloodDonor $bloodDonor)
    {
        return view('bloodDonor.show', compact('bloodDonor'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodDonor $bloodDonor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BloodDonor $bloodDonor)
    {
        return view('bloodDonor.edit', compact('bloodDonor'));
    }

    /**
     * @param \App\Http\Requests\BloodDonorUpdateRequest $request
     * @param \App\Models\BloodDonor $bloodDonor
     * @return \Illuminate\Http\Response
     */
    public function update(BloodDonorUpdateRequest $request, BloodDonor $bloodDonor)
    {
        $bloodDonor->update($request->validated());

        $request->session()->flash('bloodDonor.id', $bloodDonor->id);

        return redirect()->route('bloodDonor.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodDonor $bloodDonor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BloodDonor $bloodDonor)
    {
        $bloodDonor->delete();

        return redirect()->route('bloodDonor.index');
    }
}
