<?php

namespace App\Http\Controllers;

use App\Helpers\SlaHelper;
use App\Models\Activities;
use App\Models\Ticket;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        
        $activities = Activities::paginate(5);
        $total      = Ticket::count();
        $todo       = Ticket::where('status', 'TODO')->count();
        $pending    = Ticket::where('status', 'PENDING')->count();
        $progress   = Ticket::where('status', 'PROGRESS')->count();
        $needReview = Ticket::where('status', 'NEED_REVIEW')->count();
        $done       = Ticket::where('status', 'DONE')->count();

        // Tentukan rentang minggu kerja
        $today = Carbon::now();

        if ($today->isWeekend()) {
            // Sabtu/Minggu → pakai minggu kerja kemarin (Senin–Jumat lalu)
            $weekStart = $today->copy()->previous(Carbon::MONDAY);
            $weekEnd   = $today->copy()->previous(Carbon::FRIDAY)->endOfDay();
        } else {
            // Senin–Jumat → pakai minggu ini (Senin sampai sekarang)
            $weekStart = $today->copy()->startOfWeek(Carbon::MONDAY);
            $weekEnd   = $today->copy();
        }

        // SLA — tiket dalam rentang minggu kerja aktif
        $tickets = Ticket::whereIn('status', ['TODO', 'PROGRESS', 'DONE'])
            ->whereNotNull('classification')
            ->whereBetween('created_at', [$weekStart, $weekEnd])
            ->get(['status', 'classification', 'created_at', 'finished_at']);

        $slaOnTrack  = 0;
        $slaAtRisk   = 0;
        $slaBreached = 0;

        foreach ($tickets as $ticket) {
            $finishedAt = $ticket->finished_at
                ? Carbon::parse($ticket->finished_at)
                : null;

            $status = SlaHelper::getStatus(
                Carbon::parse($ticket->created_at),
                $finishedAt,
                $ticket->classification,
                $weekEnd // pass weekEnd sebagai "now" kalau weekend
            );

            match ($status) {
                'on_track' => $slaOnTrack++,
                'at_risk'  => $slaAtRisk++,
                'breached' => $slaBreached++,
            };
        }

        return view('pages.dashboard', compact(
            'activities', 'total', 'todo', 'pending', 'progress', 'needReview', 'done',
            'slaOnTrack', 'slaAtRisk', 'slaBreached',
            'weekStart', 'weekEnd' // opsional, buat ditampilkan di blade
        ));
    }
}