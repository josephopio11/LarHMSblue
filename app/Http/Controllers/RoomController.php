<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomStoreRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rooms = Room::all();

        return view('room.index', compact('rooms'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('room.create');
    }

    /**
     * @param \App\Http\Requests\RoomStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomStoreRequest $request)
    {
        $room = Room::create($request->validated());

        $request->session()->flash('room.id', $room->id);

        return redirect()->route('room.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Room $room)
    {
        return view('room.show', compact('room'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Room $room)
    {
        return view('room.edit', compact('room'));
    }

    /**
     * @param \App\Http\Requests\RoomUpdateRequest $request
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function update(RoomUpdateRequest $request, Room $room)
    {
        $room->update($request->validated());

        $request->session()->flash('room.id', $room->id);

        return redirect()->route('room.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Room $room)
    {
        $room->delete();

        return redirect()->route('room.index');
    }
}
