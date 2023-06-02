<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use App\Models\Ticket;
use App\Rules\UniqueSeat;
use Exception;

class TicketController extends Controller
{
    /**
     * Create ticket
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'departure_time' => 'required|date|after:' . Carbon::now(),
            'source_airport' => 'required|string',
            'destination_airport' => 'required|string',
            'seat' => [
                'required',
                'numeric',
                'min:1',
                'max:32',
                new UniqueSeat($request->input('departure_time'), $request->input('source_airport'), $request->input('destination_airport'))
            ],
            'passport_id' => 'required|string|unique:tickets'
        ]);

        try {
            $ticket = new Ticket;

            $ticket->departure_time = $request->input('departure_time');
            $ticket->source_airport = $request->input('source_airport');
            $ticket->destination_airport = $request->input('destination_airport');
            $ticket->seat = $request->input('seat');
            $ticket->passport_id = $request->input('passport_id');

            $ticket->save();

            return response()->json([
                'msg' => 'Ticket has been created successfully.',
                'ticket' => $ticket
            ], 201);
        } catch (Exception $e) {
            Log::critical($e->getMessage());

            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cancel ticket
     */
    public function cancel(string $id): JsonResponse
    {
        try {
            $ticket = Ticket::findOrFail($id);

            $ticket->delete();

            return response()->json([
                'msg' => 'Ticket has been cancelled successfully.'
            ], 202);
        } catch (Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ], 500);
        }
    }
}
