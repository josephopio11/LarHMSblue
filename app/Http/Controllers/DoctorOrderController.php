<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorOrderStoreRequest;
use App\Http\Requests\DoctorOrderUpdateRequest;
use App\Models\DoctorOrder;
use Illuminate\Http\Request;

class DoctorOrderController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $doctorOrders = DoctorOrder::all();

        return view('doctorOrder.index', compact('doctorOrders'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('doctorOrder.create');
    }

    /**
     * @param \App\Http\Requests\DoctorOrderStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorOrderStoreRequest $request)
    {
        $doctorOrder = DoctorOrder::create($request->validated());

        $request->session()->flash('doctorOrder.id', $doctorOrder->id);

        return redirect()->route('doctorOrder.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DoctorOrder $doctorOrder
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, DoctorOrder $doctorOrder)
    {
        return view('doctorOrder.show', compact('doctorOrder'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DoctorOrder $doctorOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, DoctorOrder $doctorOrder)
    {
        return view('doctorOrder.edit', compact('doctorOrder'));
    }

    /**
     * @param \App\Http\Requests\DoctorOrderUpdateRequest $request
     * @param \App\Models\DoctorOrder $doctorOrder
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorOrderUpdateRequest $request, DoctorOrder $doctorOrder)
    {
        $doctorOrder->update($request->validated());

        $request->session()->flash('doctorOrder.id', $doctorOrder->id);

        return redirect()->route('doctorOrder.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DoctorOrder $doctorOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, DoctorOrder $doctorOrder)
    {
        $doctorOrder->delete();

        return redirect()->route('doctorOrder.index');
    }
}
