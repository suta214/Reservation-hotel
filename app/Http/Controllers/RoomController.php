<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|string|unique:rooms,number',
            'type' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'amenities' => 'nullable|array',
            'is_available' => 'boolean'
        ]);

        if (isset($validated['amenities'])) {
            $validated['amenities'] = json_encode($validated['amenities']);
        }

        Room::create($validated);

        return redirect()->route('rooms.index')
            ->with('success', 'Room created successfully.');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'number' => 'required|string|unique:rooms,number,' . $room->id,
            'type' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'amenities' => 'nullable|array',
            'is_available' => 'boolean'
        ]);

        if (isset($validated['amenities'])) {
            $validated['amenities'] = json_encode($validated['amenities']);
        }

        $room->update($validated);

        return redirect()->route('rooms.index')
            ->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        // Check if room has any active reservations
        if ($room->reservations()->where('status', '!=', 'cancelled')->exists()) {
            return back()->withErrors(['delete' => 'Cannot delete room with active reservations.']);
        }

        $room->delete();

        return redirect()->route('rooms.index')
            ->with('success', 'Room deleted successfully.');
    }
} 