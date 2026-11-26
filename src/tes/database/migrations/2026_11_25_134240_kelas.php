<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('keterangan')->nullable(); // contoh: jam perkuliahan
            $table->boolean('aktif')->default(true);  // false = tidak bisa dipilih pendaftar
            $table->timestamps();
        });

        // Data awal (lookup table, jadi aman diisi di migration)
        $now = now();
        DB::table('kelas')->insert([
            ['nama' => 'Kelas pagi',  'keterangan' => null, 'aktif' => true, 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Kelas malam', 'keterangan' => null, 'aktif' => true, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
