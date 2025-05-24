<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class ReservationController extends Controller
{
    public function create()
    {
        $rooms = Room::where('is_available', true)->get();
        return view('reservations.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string'
        ]);

        $room = Room::findOrFail($request->room_id);
        
        if (!$room->isAvailableForDates($request->check_in_date, $request->check_out_date)) {
            return back()->withErrors(['room_id' => 'Cette chambre n\'est pas disponible pour les dates sélectionnées.'])
                        ->withInput();
        }

        $checkIn = Carbon::parse($request->check_in_date);
        $checkOut = Carbon::parse($request->check_out_date);
        $numberOfNights = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->price_per_night * $numberOfNights;

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'number_of_guests' => $request->number_of_guests,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'special_requests' => $request->special_requests
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Votre réservation a été créée avec succès !');
    }

    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('room')
            ->orderBy('check_in_date', 'asc')
            ->get();
        return view('reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        if (Gate::denies('view', $reservation)) {
            abort(403, 'Non autorisé.');
        }
        return view('reservations.show', compact('reservation'));
    }

    public function cancel(Reservation $reservation)
    {
        if (Gate::denies('cancel', $reservation)) {
            abort(403, 'Non autorisé.');
        }
        
        if ($reservation->status === 'pending' || $reservation->status === 'confirmed') {
            $reservation->update(['status' => 'cancelled']);
            return redirect()->route('reservations.index')
                ->with('success', 'Réservation annulée avec succès.');
        }

        return back()->withErrors(['status' => 'Cette réservation ne peut pas être annulée.']);
    }

    public function confirm(Reservation $reservation)
    {
        if (Gate::denies('update', $reservation)) {
            abort(403, 'Non autorisé.');
        }

        if ($reservation->status === 'pending') {
            $reservation->update(['status' => 'confirmed']);
            return redirect()->route('reservations.index')
                ->with('success', 'La réservation a été confirmée avec succès.');
        }

        return back()->withErrors(['status' => 'Cette réservation ne peut pas être confirmée.']);
    }
}
