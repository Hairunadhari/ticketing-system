<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($ticket) {

            $random = strtoupper(Str::random(3));

            $ticket->code = 'TKT-' . now()->format('YmdHis') . '-' . $random;
            // SLA berdasarkan classification
            $hours = match (strtolower($ticket->classification)) {
                'p0' => 2,
                'p1' => 4,
                'p2' => 6,
                'p3' => 8,
                'p4' => 24,
                default => null,
            };

            if ($hours) {
                $ticket->date_range = now()->addHours($hours);
            }
        });
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function pendingBy()
    {
        return $this->belongsTo(User::class, 'pending_by');
    }

    public function handledBy()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }
}
