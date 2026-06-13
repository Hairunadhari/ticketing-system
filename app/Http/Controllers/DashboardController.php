<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $activities = Activities::paginate(5);
        $total = Ticket::count();
        
        return view('pages.dashboard', compact('activities')); 
    }
}
