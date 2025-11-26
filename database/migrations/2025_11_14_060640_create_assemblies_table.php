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
        Schema::create('0_hw_assembly', function (Blueprint $table) {
            $table->id('assembly_id'); // Changed id() to id('assembly_id')
            $table->string('assembly_code');
            $table->string('description', 500);
            $table->string('ip_address', 15);
            $table->string('location_id'); // Changed to string to match loc_code type
            $table->foreign('location_id')->references('loc_code')->on('0_seva_locations')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('0_users');
            $table->text('remark')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->foreignId('created_by')->constrained('0_users');
            $table->foreignId('modified_by')->constrained('0_users');
            $table->timestamps();
        });
        if (!Schema::hasTable('0_hw_assembly')) {
            Schema::create('0_hw_assembly', function (Blueprint $table) {
                // IMPORTANT: Keep your original column definitions here!
                // For example: $table->id(); $table->string('name');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('0_hw_assembly');
    }
};
