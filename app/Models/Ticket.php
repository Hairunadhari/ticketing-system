<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

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
