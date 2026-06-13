<?php

namespace App\Helpers;

use Carbon\Carbon;

class SlaHelper
{
    /**
     * Durasi SLA per classification (dalam jam)
     */
    public static function getSlaDurationHours(string $classification): int
    {
        return match (strtoupper($classification)) {
            'P0' => 2,
            'P1' => 4,
            'P2' => 6,
            'P3' => 8,
            'P4' => 24,
            default => 8,
        };
    }

    /**
     * Tambah jam kerja (Senin-Jumat) dari tanggal awal
     */
    public static function addWorkingHours(Carbon $date, int $hours): Carbon
    {
        $result = $date->copy();
        $added = 0;

        while ($added < $hours) {
            $result->addHour();
            // Skip Sabtu & Minggu
            if (!in_array($result->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                $added++;
            }
        }

        return $result;
    }

    /**
     * Tentukan status SLA berdasarkan classification & finished_at
     */
    public static function getStatus(
        Carbon $createdAt,
        ?Carbon $finishedAt,
        string $classification,
        ?Carbon $referenceTime = null  // ← tambah ini
    ): string {
        $hours    = self::getSlaDurationHours($classification);
        $deadline = self::addWorkingHours($createdAt, $hours);
        $now      = $referenceTime ?? Carbon::now(); // pakai referenceTime kalau ada

        if ($finishedAt) {
            return $finishedAt->lte($deadline) ? 'on_track' : 'breached';
        }

        if ($now->gt($deadline)) {
            return 'breached';
        }

        $remainingHours  = $now->diffInHours($deadline, false);
        $atRiskThreshold = $hours * 0.25;

        if ($remainingHours <= $atRiskThreshold) {
            return 'at_risk';
        }

        return 'on_track';
    }
}