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
        Schema::create('0_seva_locations', function (Blueprint $table) {
            $table->string('loc_code')->primary(); // Replaced id() with loc_code as primary key
            $table->string('location_name');
            $table->string('parent_id')->nullable(); // Changed to string to match loc_code type
            $table->foreign('parent_id')->references('loc_code')->on('0_seva_locations')->onDelete('cascade'); // Foreign key to self
            $table->boolean('inactive')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('0_seva_locations');
    }
};
