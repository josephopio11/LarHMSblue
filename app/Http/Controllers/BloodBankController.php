<?php

namespace App\Http\Controllers;

use App\Http\Requests\BloodBankStoreRequest;
use App\Http\Requests\BloodBankUpdateRequest;
use App\Models\BloodBank;
use Illuminate\Http\Request;

class BloodBankController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bloodBanks = BloodBank::all();

        return view('bloodBank.index', compact('bloodBanks'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('bloodBank.create');
    }

    /**
     * @param \App\Http\Requests\BloodBankStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BloodBankStoreRequest $request)
    {
        $bloodBank = BloodBank::create($request->validated());

        $request->session()->flash('bloodBank.id', $bloodBank->id);

        return redirect()->route('bloodBank.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodBank $bloodBank
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BloodBank $bloodBank)
    {
        return view('bloodBank.show', compact('bloodBank'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodBank $bloodBank
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BloodBank $bloodBank)
    {
        return view('bloodBank.edit', compact('bloodBank'));
    }

    /**
     * @param \App\Http\Requests\BloodBankUpdateRequest $request
     * @param \App\Models\BloodBank $bloodBank
     * @return \Illuminate\Http\Response
     */
    public function update(BloodBankUpdateRequest $request, BloodBank $bloodBank)
    {
        $bloodBank->update($request->validated());

        $request->session()->flash('bloodBank.id', $bloodBank->id);

        return redirect()->route('bloodBank.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BloodBank $bloodBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BloodBank $bloodBank)
    {
        $bloodBank->delete();

        return redirect()->route('bloodBank.index');
    }
}
