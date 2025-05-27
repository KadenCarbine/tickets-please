<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ReplaceTicketRequest;
use App\Http\Requests\Api\V1\StoreTicketRequest;
use App\Http\Requests\Api\V1\UpdateTicketRequest;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Filters\V1\TicketFilter;
use App\Http\Resources\V1\TicketResource;

class AuthorsTicketController extends ApiController
{
    public function index($author_id, TicketFilter $filters)
    {
        return TicketResource::collection(
            Ticket::where('user_id', $author_id)
            ->filter($filters)
            ->paginate());
    }

    public function store($author_id, StoreTicketRequest $request)
    {
        return new TicketResource(Ticket::create($request->mappedAttributes()));
    }

    /**
     * Replace the specified resource in storage.
     */
    public function replace(ReplaceTicketRequest $request, $authorId, $ticketId)
    {
        try {
            $ticket = Ticket::findOrFail($ticketId);

            if($ticket->user_id == $authorId) {
                $ticket->update($request->mappedAttributes());
                return new TicketResource($ticket);
            }


        } catch (ModelNotFoundException $e) {
            $this->error('Ticket not found', 404);
        }
    }

    /**
     * Replace the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, $authorId, $ticketId)
    {
        try {
            $ticket = Ticket::findOrFail($ticketId);

            if($ticket->user_id == $authorId) {
                $ticket->update($request->mappedAttributes());
                return new TicketResource($ticket);
            }


        } catch (ModelNotFoundException $e) {
            $this->error('Ticket not found', 404);
        }
    }

    public function destroy($authorId, $ticketId) {
        try {
            $ticket = Ticket::findOrFail($ticketId);

            if($ticket->user_id == $authorId) {
                $ticket->delete();
                return response()->json(['message' => 'Ticket successfully deleted'], 200);
            }

            return response()->json(['error' => 'Ticket cannot be found'], 404);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => 'Ticket cannot be found'], 404);
        }
    }
}
