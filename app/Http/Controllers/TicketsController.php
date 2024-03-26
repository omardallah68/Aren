<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Coderflex\LaravelTicket\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TicketsController extends Controller
{
    public function show()
    {
        return Inertia::render('Tickets/Tickets');
    }

    public function get()
    {

        $ticketsWithLowPriority = Ticket::with(['user','assignedToUser'])->withLowPriority()->get();
        $ticketsWithNormalPriority = Ticket::with(['user','assignedToUser'])->withNormalPriority()->get();
        $ticketsWithHighPriority = Ticket::with(['user','assignedToUser'])->withHighPriority()->get();

        return response()->json([
            'tickets' => Ticket::with(['user','assignedToUser'])->orderByDesc('uuid')->get(),
            'ticketsWithLowPriority' => $ticketsWithLowPriority,
            'ticketsWithNormalPriority' => $ticketsWithNormalPriority,
            'ticketsWithHighPriority' => $ticketsWithHighPriority
            ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $user->tickets()->create($request->toArray());
        return response()->json([
        ]);
    }

    public function close(Request $request)
    {
        $ticket = Ticket::find($request->input('id'));
        $ticket->close();
        return response()->json([
            "message" => 'The Ticket with this uuid '. $ticket->uuid .' is closed'
        ]);
    }

    public function reopen(Request $request)
    {
        $ticket = Ticket::find($request->input('id'));
        $ticket->reopen();
        return response()->json([
            "message" => 'The Ticket with this uuid '. $ticket->uuid .' is opened'
        ]);
    }

    public function closeAsResolved(Request $request)
    {
        $ticket = Ticket::find($request->input('id'));
        $ticket->closeAsResolved();
        return response()->json([
            "message" => 'The Ticket with this uuid '. $ticket->uuid .' is closed as resolved'
        ]);
    }

    public function closeAsUnresolved(Request $request)
    {
        $ticket = Ticket::find($request->input('id'));
        $ticket->closeAsUnresolved();
        return response()->json([
            "message" => 'The Ticket with this uuid '. $ticket->uuid .' is closed as unresolved'
        ]);
    }


    public function reopenAsUnresolved(Request $request)
    {
        $ticket = Ticket::find($request->input('id'));
        $ticket->reopenAsUnresolved();
        return response()->json([
            "message" => 'The Ticket with this uuid '. $ticket->uuid .' is reopened as unresolved'
        ]);
    }

    public function archive(Request $request)
    {
        $ticket = Ticket::find($request->input('id'));
        $ticket->archive();
        return response()->json([
            "message" => 'The Ticket with this uuid '. $ticket->uuid .' is archived'
        ]);
    }

    public function lock(Request $request)
    {
        $ticket = Ticket::find($request->input('id'));
        $ticket->markAsLocked();
        return response()->json([
            "message" => 'The Ticket with this uuid '. $ticket->uuid .' is locked'
        ]);
    }

    public function unlock(Request $request)
    {
        $ticket = Ticket::find($request->input('id'));
        $ticket->markAsUnlocked();
        return response()->json([
            "message" => 'The Ticket with this uuid '. $ticket->uuid .' is unlocked'
        ]);
    }

    public function markAsResolved(Request $request)
    {
        $ticket = Ticket::find($request->input('id'));
        $ticket->markAsResolved();
        return response()->json([
            "message" => 'The Ticket with this uuid '. $ticket->uuid .' is as resolved marked'
        ]);
    }
}

