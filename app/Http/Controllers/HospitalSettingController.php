<?php

namespace App\Http\Controllers;

use App\Http\Requests\HospitalSettingStoreRequest;
use App\Http\Requests\HospitalSettingUpdateRequest;
use App\Models\HospitalSetting;
use Illuminate\Http\Request;

class HospitalSettingController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hospitalSettings = HospitalSetting::all();

        return view('hospitalSetting.index', compact('hospitalSettings'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('hospitalSetting.create');
    }

    /**
     * @param \App\Http\Requests\HospitalSettingStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HospitalSettingStoreRequest $request)
    {
        $hospitalSetting = HospitalSetting::create($request->validated());

        $request->session()->flash('hospitalSetting.id', $hospitalSetting->id);

        return redirect()->route('hospitalSetting.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HospitalSetting $hospitalSetting
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, HospitalSetting $hospitalSetting)
    {
        return view('hospitalSetting.show', compact('hospitalSetting'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HospitalSetting $hospitalSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, HospitalSetting $hospitalSetting)
    {
        return view('hospitalSetting.edit', compact('hospitalSetting'));
    }

    /**
     * @param \App\Http\Requests\HospitalSettingUpdateRequest $request
     * @param \App\Models\HospitalSetting $hospitalSetting
     * @return \Illuminate\Http\Response
     */
    public function update(HospitalSettingUpdateRequest $request, HospitalSetting $hospitalSetting)
    {
        $hospitalSetting->update($request->validated());

        $request->session()->flash('hospitalSetting.id', $hospitalSetting->id);

        return redirect()->route('hospitalSetting.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HospitalSetting $hospitalSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, HospitalSetting $hospitalSetting)
    {
        $hospitalSetting->delete();

        return redirect()->route('hospitalSetting.index');
    }
}
