<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

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
}
