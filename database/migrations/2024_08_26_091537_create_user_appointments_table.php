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
        Schema::create('user_appointments', function (Blueprint $table) {
        $table->id();
        $table->string('full_name');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('service_center_id')->constrained()->onDelete('cascade');
        $table->foreignId('services_id')->constrained()->onDelete('cascade');
        $table->string('location')->nullable();
        $table->date('schedule_date');
        $table->time('schedule_time');
        $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_appointments');
    }
};

