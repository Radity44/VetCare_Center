<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            // Cek dulu apakah kolom sudah ada, kalau belum baru tambahkan
            if (!Schema::hasColumn('visits', 'keluhan')) {
                $table->text('keluhan')->nullable()->after('tanggal_kunjungan');
            }
            
            if (!Schema::hasColumn('visits', 'diagnosis')) {
                $table->text('diagnosis')->nullable()->after('keluhan');
            }
            
            if (!Schema::hasColumn('visits', 'tindakan')) {
                $table->text('tindakan')->nullable()->after('diagnosis');
            }
            
            if (!Schema::hasColumn('visits', 'catatan')) {
                $table->text('catatan')->nullable()->after('tindakan');
            }
            
            if (!Schema::hasColumn('visits', 'total_biaya')) {
                $table->decimal('total_biaya', 10, 2)->nullable()->after('catatan');
            }
            
            if (!Schema::hasColumn('visits', 'status_visit')) {
                $table->enum('status_visit', ['Scheduled', 'In Progress', 'Completed', 'Cancelled'])
                      ->default('Scheduled')
                      ->after('total_biaya');
            }
        });
    }

    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            // Rollback: hapus kolom yang ditambahkan
            if (Schema::hasColumn('visits', 'keluhan')) {
                $table->dropColumn('keluhan');
            }
            if (Schema::hasColumn('visits', 'diagnosis')) {
                $table->dropColumn('diagnosis');
            }
            if (Schema::hasColumn('visits', 'tindakan')) {
                $table->dropColumn('tindakan');
            }
            if (Schema::hasColumn('visits', 'catatan')) {
                $table->dropColumn('catatan');
            }
            if (Schema::hasColumn('visits', 'total_biaya')) {
                $table->dropColumn('total_biaya');
            }
            if (Schema::hasColumn('visits', 'status_visit')) {
                $table->dropColumn('status_visit');
            }
        });
    }
};
