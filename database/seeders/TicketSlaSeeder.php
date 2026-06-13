<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TicketSlaSeeder extends Seeder
{
    public function run(): void
    {
          $user = User::first();

    if (!$user) {
        $this->command->error('No user found. Run UserSeeder first.');
        return;
    }

    // Pakai hari kerja terakhir (Jumat) kalau sekarang weekend
    $baseTime = Carbon::now()->isWeekend()
        ? Carbon::now()->previous(Carbon::FRIDAY)->setHour(8)->setMinute(0)
        : Carbon::now();

    $tickets = [
        // ON TRACK
        [
            'label'          => 'P0 - On Track (baru dibuat)',
            'classification' => 'P0',
            'status'         => 'TODO',
            'created_at'     => $baseTime->copy()->subMinutes(30),
            'finished_at'    => null,
        ],
        [
            'label'          => 'P1 - On Track (progress)',
            'classification' => 'P1',
            'status'         => 'PROGRESS',
            'created_at'     => $baseTime->copy()->subHours(1),
            'finished_at'    => null,
        ],
        [
            'label'          => 'P3 - On Track (done tepat waktu)',
            'classification' => 'P3',
            'status'         => 'DONE',
            'created_at'     => $baseTime->copy()->subHours(6),
            'finished_at'    => $baseTime->copy()->subHours(1),
        ],
        [
            'label'          => 'P4 - On Track (done tepat waktu)',
            'classification' => 'P4',
            'status'         => 'DONE',
            'created_at'     => $baseTime->copy()->subHours(20),
            'finished_at'    => $baseTime->copy()->subHours(5),
        ],

        // AT RISK
        [
            'label'          => 'P0 - At Risk (sisa < 30 menit)',
            'classification' => 'P0',
            'status'         => 'TODO',
            'created_at'     => $baseTime->copy()->subMinutes(90),
            'finished_at'    => null,
        ],
        [
            'label'          => 'P1 - At Risk (sisa < 1 jam)',
            'classification' => 'P1',
            'status'         => 'PROGRESS',
            'created_at'     => $baseTime->copy()->subHours(3)->subMinutes(15),
            'finished_at'    => null,
        ],
        [
            'label'          => 'P2 - At Risk (sisa < 1.5 jam)',
            'classification' => 'P2',
            'status'         => 'PROGRESS',
            'created_at'     => $baseTime->copy()->subHours(5),
            'finished_at'    => null,
        ],
        [
            'label'          => 'P3 - At Risk (sisa < 2 jam)',
            'classification' => 'P3',
            'status'         => 'TODO',
            'created_at'     => $baseTime->copy()->subHours(7),
            'finished_at'    => null,
        ],

        // BREACHED
        [
            'label'          => 'P0 - Breached (belum selesai)',
            'classification' => 'P0',
            'status'         => 'TODO',
            'created_at'     => $baseTime->copy()->subHours(3),
            'finished_at'    => null,
        ],
        [
            'label'          => 'P1 - Breached (belum selesai)',
            'classification' => 'P1',
            'status'         => 'PROGRESS',
            'created_at'     => $baseTime->copy()->subHours(6),
            'finished_at'    => null,
        ],
        [
            'label'          => 'P2 - Breached (done tapi telat)',
            'classification' => 'P2',
            'status'         => 'DONE',
            'created_at'     => $baseTime->copy()->subHours(10),
            'finished_at'    => $baseTime->copy()->subHours(2),
        ],
        [
            'label'          => 'P3 - Breached (done tapi telat)',
            'classification' => 'P3',
            'status'         => 'DONE',
            'created_at'     => $baseTime->copy()->subHours(12),
            'finished_at'    => $baseTime->copy()->subHours(1),
        ],
        [
            'label'          => 'P4 - Breached (belum selesai)',
            'classification' => 'P4',
            'status'         => 'PROGRESS',
            'created_at'     => $baseTime->copy()->subHours(30),
            'finished_at'    => null,
        ],
    ];

        foreach ($tickets as $index => $ticket) {
            Ticket::create([
                'code'           => 'TKT-SLA-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'created_by'     => $user->id,
                'classification' => $ticket['classification'],
                'status'         => $ticket['status'],
                'description'    => '[SLA TEST] ' . $ticket['label'],
                'project_name'   => 'SLA Test Project',
                'service'        => 'Test Service',
                'created_at'     => $ticket['created_at'],
                'updated_at'     => $ticket['finished_at'] ?? $ticket['created_at'],
                'finished_at'    => $ticket['finished_at'],
                'ticket_for'     => $user->id,
                'handled_by'     => $user->id,
            ]);
        }

        $this->command->info('✅ SLA Seeder berhasil! Total: ' . count($tickets) . ' tiket');
        $this->command->table(
            ['Classification', 'Status Tiket', 'Expected SLA', 'Keterangan'],
            [
                ['P0', 'TODO',     'On Track',  'Baru 30 menit, deadline 2 jam'],
                ['P1', 'PROGRESS', 'On Track',  'Baru 1 jam, deadline 4 jam'],
                ['P3', 'DONE',     'On Track',  'Selesai jam ke-5, deadline 8 jam'],
                ['P4', 'DONE',     'On Track',  'Selesai jam ke-15, deadline 24 jam'],
                ['P0', 'TODO',     'At Risk',   'Sisa ~30 menit dari 2 jam'],
                ['P1', 'PROGRESS', 'At Risk',   'Sisa ~45 menit dari 4 jam'],
                ['P2', 'PROGRESS', 'At Risk',   'Sisa 1 jam dari 6 jam'],
                ['P3', 'TODO',     'At Risk',   'Sisa 1 jam dari 8 jam'],
                ['P0', 'TODO',     'Breached',  'Sudah 3 jam, deadline 2 jam'],
                ['P1', 'PROGRESS', 'Breached',  'Sudah 6 jam, deadline 4 jam'],
                ['P2', 'DONE',     'Breached',  'Selesai jam ke-8, deadline 6 jam'],
                ['P3', 'DONE',     'Breached',  'Selesai jam ke-11, deadline 8 jam'],
                ['P4', 'PROGRESS', 'Breached',  'Sudah 30 jam, deadline 24 jam'],
            ]
        );
    }
}