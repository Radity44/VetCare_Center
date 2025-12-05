<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah kolom status jadi string dulu (karena enum tidak bisa diubah langsung)
        DB::statement("ALTER TABLE patients MODIFY COLUMN status VARCHAR(50)");
    }

    public function down(): void
    {
        // Rollback: kembalikan ke varchar
        DB::statement("ALTER TABLE patients MODIFY COLUMN status VARCHAR(50)");
    }
};
