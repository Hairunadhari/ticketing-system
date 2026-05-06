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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('company')->nullable();
            $table->string('country')->nullable();
            $table->string('operator')->nullable();
            $table->string('service')->nullable();
            $table->string('project_name')->nullable();
            $table->string('classification')->nullable();
            $table->string('status')->nullable();
            $table->string('date_range')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
