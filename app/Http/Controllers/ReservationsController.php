<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Books;
use App\Models\Reservations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::all();
        $userReservations = Auth::user()->reservations;
    
        return view('home', compact('books', 'userReservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
{

    $book = Books::findOrFail($request->bookId);

    Reservations::create([
        'user_id' => Auth::id(),
        'book_id' => $book->id,
        'return_date' => $request->returnDate,
        'description' => 'reserved',
    ]);

    return redirect()->back()->with('success', 'Reservation successful!')->with('delay', 1000);
}

    /**
     * Display the specified resource.
     */
    public function show(Reservations $reservations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservations $reservations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservations $reservations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservations = Reservations::findOrFail($id);
        $reservations->delete();
        return redirect('reservations');
    }
}
