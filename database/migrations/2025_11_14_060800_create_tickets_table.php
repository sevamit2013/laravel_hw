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
        Schema::create('0_tkt_header', function (Blueprint $table) {
            $table->id('tkt_id'); // Changed id() to id('tkt_id') to match primary key in model
            $table->string('title');
            $table->text('description');
            $table->foreignId('priority_id')->constrained('priorities');
            $table->foreignId('type_id')->references('type_id')->on('0_tkt_types'); // Changed ticket_type_id to type_id and constrained to 0_tkt_types type_id
            $table->foreignId('assign_id')->nullable()->constrained('0_users'); // Changed assigned_to to assign_id
            $table->foreignId('status_id')->constrained('ticket_statuses'); // Changed ticket_status_id to status_id
            $table->foreignId('asset_id')->nullable()->references('asset_id')->on('0_hw_assets'); // Constrained to 0_hw_assets asset_id
            $table->foreignId('assembly_id')->nullable()->references('assembly_id')->on('0_hw_assembly'); // Constrained to 0_hw_assembly assembly_id
            $table->string('loc_code'); // Changed location_id to loc_code
            $table->foreign('loc_code')->references('loc_code')->on('0_seva_locations')->onDelete('cascade'); // Foreign key to 0_seva_locations
            $table->date('due_date');
            $table->foreignId('created_by')->constrained('0_users');
            $table->foreignId('modified_by')->constrained('0_users')->nullable(); // Added modified_by
            $table->string('seeker_name');
            $table->boolean('is_closed')->default(false);
            $table->boolean('is_reopen')->default(false);
            $table->boolean('is_approved')->default(true);
            $table->boolean('inactive')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('0_tkt_header');
    }
};
