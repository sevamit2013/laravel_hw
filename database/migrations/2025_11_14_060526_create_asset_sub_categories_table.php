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
        Schema::create('0_hw_sub_category', function (Blueprint $table) {
            $table->id('sub_cat_id'); // Changed id() to id('sub_cat_id') to match primary key in model
            $table->string('description');
            $table->foreignId('asset_category_id')->references('category_id')->on('0_hw_stock_category'); // Explicitly reference category_id
            $table->boolean('inactive')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('0_hw_sub_category');
    }
};
