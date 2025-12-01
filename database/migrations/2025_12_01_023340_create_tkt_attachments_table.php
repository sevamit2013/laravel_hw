<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('0_tkt_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id');
            $table->string('filename');
            $table->string('original_filename');
            $table->string('mime_type');
            $table->integer('file_size');
            $table->string('path');
            $table->unsignedBigInteger('uploaded_by');
            $table->timestamps();
            
            $table->foreign('ticket_id')->references('tkt_id')->on('0_tkt_header')->onDelete('cascade');
            $table->foreign('uploaded_by')->references('id')->on('0_users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('0_tkt_attachments');
    }
};