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
        Schema::table('audits', function (Blueprint $table) {
            // Change the column type to string (VARCHAR) to accommodate 'ROOT' and future string IDs
            $table->string('auditable_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audits', function (Blueprint $table) {
            // Change it back if needed (or just revert the migration)
            // Assuming original was a BIGINT. Adjust if yours was different.
            $table->unsignedBigInteger('auditable_id')->nullable()->change();
        });
    }
};