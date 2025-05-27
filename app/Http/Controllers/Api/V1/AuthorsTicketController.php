<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\StoreTicketRequest;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Filters\V1\TicketFilter;
use App\Http\Resources\V1\TicketResource;

class AuthorsTicketController extends Controller
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

        $model = [
            'title' => $request->input('data.attributes.title'),
            'description' => $request->input('data.attributes.description'),
            'status' => $request->input('data.attributes.status'),
            'user_id' => $author_id
        ];

        return new TicketResource(Ticket::create($model));
    }

    public function destroy($author_id, $ticketId) {
        try {
            $ticket = Ticket::findOrFail($ticketId);

            if(!$ticket->user_id == $author_id) {
                return response()->json(['error' => 'Ticket cannot be found'], 404);
            }
            $ticket->delete();

            return response()->json(['message' => 'Ticket successfully deleted'], 200);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => 'Ticket cannot be found'], 404);
        }
    }
}
