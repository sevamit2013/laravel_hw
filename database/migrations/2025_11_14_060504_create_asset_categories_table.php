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
        Schema::create('0_hw_stock_category', function (Blueprint $table) {
            $table->id('category_id'); // Changed id() to id('category_id') to match primary key in model
            $table->string('description');
            $table->boolean('is_software')->default(false);
            $table->boolean('inactive')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('0_hw_stock_category');
    }
};
