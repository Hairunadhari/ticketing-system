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
        $tickets = Ticket::paginate(10); // Assuming you have a Ticket model
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
        ]);

        return redirect()->route('tickets.list')->with('success', 'Ticket created successfully.');
    }

    public function detail($id)
    {
        // Logic to show detail of a ticket
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
}
