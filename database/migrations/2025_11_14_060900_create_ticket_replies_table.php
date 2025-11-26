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
        Schema::create('0_tkt_reply', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->references('tkt_id')->on('0_tkt_header'); // Constrained to 0_tkt_header tkt_id
            $table->text('description');
            $table->foreignId('user_id')->constrained('0_users');
            $table->boolean('unread')->default(false);
            $table->boolean('inactive')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('0_tkt_reply');
    }
};
