<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedback_responses', function (Blueprint $table) {
            $table->integer('id_response', true);
            $table->integer('report_id');
            $table->integer('admin_id');
            $table->text('response_text');
            $table->timestamps();

            $table->foreign('report_id')->references('id_report')->on('reports')->onDelete('cascade');
            $table->foreign('admin_id')->references('id_user')->on('users')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback_responses');
    }
};