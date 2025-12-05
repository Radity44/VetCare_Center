<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pasien')->constrained('patients')->onDelete('cascade');
            $table->foreignId('id_dokter')->constrained('doctors')->onDelete('cascade');
            $table->foreignId('id_layanan')->constrained('services')->onDelete('cascade');
            $table->dateTime('tanggal_kunjungan');
            $table->text('keluhan')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('tindakan')->nullable();
            $table->text('catatan')->nullable();
            $table->decimal('total_biaya', 10, 2)->nullable();
            $table->enum('status_visit', ['Scheduled', 'In Progress', 'Completed', 'Cancelled'])->default('Scheduled');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
