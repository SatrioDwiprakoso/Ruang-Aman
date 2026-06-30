<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('evidences', function (Blueprint $table) {
            $table->integer('id_evidence', true);
            $table->integer('report_id');
            $table->string('file_path', 500);

            $table->foreign('report_id')->references('id_report')->on('reports')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evidences');
    }
};