<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->integer('id_report', true);
            $table->integer('user_id');
            $table->integer('category_id');
            $table->string('title', 200);
            $table->text('chronology');
            $table->boolean('is_anonymous')->default(false);
            $table->string('tracking_token', 50)->unique();
            $table->enum('status', ['Pending', 'Diproses', 'Selesai', 'Ditolak'])->default('Pending');
            $table->timestamp('created_at')->nullable();

            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id_category')->on('categories')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};