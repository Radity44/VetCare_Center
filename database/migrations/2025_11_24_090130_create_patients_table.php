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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_hewan'); // nama hewan
            $table->string('jenis_hewan'); // jenis hewan (kucing/anjing/dll)
            $table->string('ras')->nullable();// ras hewan
            $table->integer('umur_hewan')->nullable();
            $table->enum('jenis_kelamin', ['Jantan', 'Betina'])->nullable();
            $table->text('riwayat_perawatan')->nullable();
            $table->enum('status', [
                'Booking',  
                'Pemeriksaan',
                'Pra-Karantina',
                'Operasi',
                'Pasca-Karantina',
                'Rawat Jalan',
                'Selesai']
            )->default('Booking');
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
