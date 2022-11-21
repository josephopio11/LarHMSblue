<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomTypeStoreRequest;
use App\Http\Requests\RoomTypeUpdateRequest;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roomTypes = RoomType::all();

        return view('roomType.index', compact('roomTypes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('roomType.create');
    }

    /**
     * @param \App\Http\Requests\RoomTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomTypeStoreRequest $request)
    {
        $roomType = RoomType::create($request->validated());

        $request->session()->flash('roomType.id', $roomType->id);

        return redirect()->route('roomType.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RoomType $roomType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, RoomType $roomType)
    {
        return view('roomType.show', compact('roomType'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RoomType $roomType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, RoomType $roomType)
    {
        return view('roomType.edit', compact('roomType'));
    }

    /**
     * @param \App\Http\Requests\RoomTypeUpdateRequest $request
     * @param \App\Models\RoomType $roomType
     * @return \Illuminate\Http\Response
     */
    public function update(RoomTypeUpdateRequest $request, RoomType $roomType)
    {
        $roomType->update($request->validated());

        $request->session()->flash('roomType.id', $roomType->id);

        return redirect()->route('roomType.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RoomType $roomType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, RoomType $roomType)
    {
        $roomType->delete();

        return redirect()->route('roomType.index');
    }
}
