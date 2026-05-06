<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->text('pending_reason')->nullable();          // Alasan pending
$table->date('pending_estimated_done')->nullable();  // Estimasi selesai pending
$table->timestamp('pending_at')->nullable();         // Waktu di-set pending
$table->timestamp('resumed_at')->nullable();         // Waktu di-resume dari pending
$table->bigInteger('pending_by')->nullable(); // Siapa yang set pending
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            //
        });
    }
};
