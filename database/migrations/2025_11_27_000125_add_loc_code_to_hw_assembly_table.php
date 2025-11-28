<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('0_hw_assembly', function (Blueprint $table) {
        $table->string('loc_code')->nullable()->after('description');
        // Or if it's a foreign key:
        // $table->foreignId('loc_code')->nullable()->constrained('0_locations');
    });
}

public function down()
{
    Schema::table('0_hw_assembly', function (Blueprint $table) {
        $table->dropColumn('loc_code');
    });
}
    
};
