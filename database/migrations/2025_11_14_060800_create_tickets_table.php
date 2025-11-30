<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('0_tkt_header', function (Blueprint $table) {
            // Add expected and actual time fields
            $table->integer('expected_time_hours')->nullable()->after('assign_id');
            $table->integer('actual_time_hours')->nullable()->after('expected_time_hours');
            
            // Add unread count for replies
            $table->integer('unread_count')->default(0)->after('is_approved');
        });
        
        // Create ticket attachments table
        Schema::create('0_tkt_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->references('tkt_id')->on('0_tkt_header')->onDelete('cascade');
            $table->foreignId('reply_id')->nullable()->constrained('0_tkt_reply')->onDelete('cascade');
            $table->string('filename');
            $table->string('original_filename');
            $table->string('mime_type');
            $table->integer('file_size');
            $table->string('path');
            $table->foreignId('uploaded_by')->constrained('0_users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('0_tkt_header', function (Blueprint $table) {
            $table->dropColumn(['expected_time_hours', 'actual_time_hours', 'unread_count']);
        });
        
        Schema::dropIfExists('0_tkt_attachments');
    }
};