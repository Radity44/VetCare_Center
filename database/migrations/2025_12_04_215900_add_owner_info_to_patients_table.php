<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('nama_pemilik', 100)->nullable()->after('jenis_kelamin');
            $table->string('telepon_pemilik', 20)->nullable()->after('nama_pemilik');
            $table->text('alamat_pemilik')->nullable()->after('telepon_pemilik');
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn(['nama_pemilik', 'telepon_pemilik', 'alamat_pemilik']);
        });
    }
};
