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
        Schema::create('0_hw_assets', function (Blueprint $table) {
            $table->id('asset_id'); // Changed id() to id('asset_id')
            $table->string('asset_code');
            $table->string('description', 500);
            $table->foreignId('asset_category_id')->references('category_id')->on('0_hw_stock_category'); // Updated foreign key
            $table->foreignId('asset_sub_category_id')->references('sub_cat_id')->on('0_hw_sub_category'); // Updated foreign key
            $table->string('location_id'); // Changed to string to match loc_code type
            $table->foreign('location_id')->references('loc_code')->on('0_seva_locations')->onDelete('cascade'); // Updated foreign key
            $table->foreignId('user')->nullable()->constrained('0_users'); // Changed user_id to user
            $table->foreignId('assembly_id')->nullable()->references('assembly_id')->on('0_hw_assembly'); // Explicitly reference assembly_id
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('company_serial')->nullable();
            $table->date('purchase_date')->nullable();
            $table->float('purchase_cost')->nullable();
            $table->date('warranty_expiration_date')->nullable();
            $table->text('remark')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->foreignId('created_by')->constrained('0_users');
            $table->foreignId('modified_by')->constrained('0_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('0_hw_assets');
    }
};
