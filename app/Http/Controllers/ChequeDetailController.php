<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChequeDetailStoreRequest;
use App\Http\Requests\ChequeDetailUpdateRequest;
use App\Models\ChequeDetail;
use Illuminate\Http\Request;

class ChequeDetailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $chequeDetails = ChequeDetail::all();

        return view('chequeDetail.index', compact('chequeDetails'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('chequeDetail.create');
    }

    /**
     * @param \App\Http\Requests\ChequeDetailStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChequeDetailStoreRequest $request)
    {
        $chequeDetail = ChequeDetail::create($request->validated());

        $request->session()->flash('chequeDetail.id', $chequeDetail->id);

        return redirect()->route('chequeDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ChequeDetail $chequeDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ChequeDetail $chequeDetail)
    {
        return view('chequeDetail.show', compact('chequeDetail'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ChequeDetail $chequeDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ChequeDetail $chequeDetail)
    {
        return view('chequeDetail.edit', compact('chequeDetail'));
    }

    /**
     * @param \App\Http\Requests\ChequeDetailUpdateRequest $request
     * @param \App\Models\ChequeDetail $chequeDetail
     * @return \Illuminate\Http\Response
     */
    public function update(ChequeDetailUpdateRequest $request, ChequeDetail $chequeDetail)
    {
        $chequeDetail->update($request->validated());

        $request->session()->flash('chequeDetail.id', $chequeDetail->id);

        return redirect()->route('chequeDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ChequeDetail $chequeDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ChequeDetail $chequeDetail)
    {
        $chequeDetail->delete();

        return redirect()->route('chequeDetail.index');
    }
}
