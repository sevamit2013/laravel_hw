<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('0_tkt_header', function (Blueprint $table) {
            // Add unread_count column safely with default 0
            $table->unsignedInteger('unread_count')
                  ->default(0)
                  ->after('status'); // Adjust 'after' if needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('0_tkt_header', function (Blueprint $table) {
            $table->dropColumn('unread_count');
        });
    }
};
