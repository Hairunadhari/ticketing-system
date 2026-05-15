<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function list()
    {
        $tickets = Ticket::where('ticket_for', 2)->with('createdBy', 'handledBy')
            ->orderByRaw("
                FIELD(
                    status,
                    'TODO',
                    'PENDING',
                    'PROGRESS',
                    'NEED_REVIEW',
                    'DONE'
                )
            ")
            ->orderByRaw("
                FIELD(
                    classification,
                    'P0',
                    'P1',
                    'P2',
                    'P3',
                    'P4',
                    'P5'
                )
            ")
            ->latest()
            ->paginate(5);
        return view('pages.ticket', compact('tickets'));
    }

    public function create(Request $request)
    {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('images', $imageName, 'public');
        Ticket::create([
            'company' => $request->company,
            'country' => $request->country,
            'operator' => $request->operator,
            'service' => $request->service,
            'project_name' => $request->project_name,
            'classification' => $request->classification,
            'status' => 'TODO', // Default status
            'description' => $request->description,
            'image' => $imageName,
            'ticket_for' => $request->ticket_for,
            'created_by' => Auth::id(), // Assuming you have authentication
        ]);

        return redirect()->route('tickets.list')->with('success', 'Ticket created successfully.');
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'company' => $request->company,
            'country' => $request->country,
            'operator' => $request->operator,
            'service' => $request->service,
            'project_name' => $request->project_name,
            'classification' => $request->classification,
            'description' => $request->description,
            'status' => 'PROGRESS', // Update status to PROGRESS when edited
        ]);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('images', $imageName, 'public');
            $ticket->update(['image' => $imageName]);
        }

        return redirect()->route('tickets.list')->with('success', 'Ticket updated successfully.');
    }

    public function status($id, Request $request)
    {
        // Logic to update status of a ticket
    }

    public function export(Request $request)
    {
        // Logic to export tickets
    }

    public function setPending($id, Request $request)
    {
        $ticket = Ticket::findOrFail($id);
        if ($request->hasFile('image_pending_reason')) {
            $imageName = time() . '.' . $request->image_pending_reason->extension();
            $request->image_pending_reason->storeAs('images', $imageName, 'public');
            // You can save this image name to a new column if needed
        }
        $ticket->pending_reason = $request->pending_reason;
        $ticket->pending_at = Carbon::now('Asia/Jakarta');
        $ticket->pending_by = Auth::id() ?? null; // Assuming you have authentication
        $ticket->status = 'PENDING';
        $ticket->image_pending_reason = $imageName ?? null; // Save the image name if uploaded
        $ticket->save();


        return redirect()->route('tickets.list')->with('success', 'Ticket set to pending successfully.');
    }

    public function startWork($id, Request $request)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'PROGRESS';
        $ticket->started_at = Carbon::now('Asia/Jakarta');
        $ticket->handled_by = Auth::id() ?? null; // Assuming you have authentication
        $ticket->save();

        return redirect()->route('tickets.list')->with('success', 'Work started on the ticket successfully.');
    }

    public function delete($id, Request $request)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.list')->with('success', 'Ticket deleted successfully.');
    }

    public function finishWork($id, Request $request)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'NEED_REVIEW';
        $ticket->save();

        return redirect()->route('tickets.list')->with('success', 'Work finished on the ticket successfully.');
    }

    public function close($id, Request $request)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'DONE';
        $ticket->finished_at = Carbon::now('Asia/Jakarta');
        $ticket->save();

        return redirect()->route('tickets.list')->with('success', 'Ticket closed successfully.');
    }
}
