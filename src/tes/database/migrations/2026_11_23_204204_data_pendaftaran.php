<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_pendaftar', function (Blueprint $table) {
            $table->id('idpendaftar');
            $table->string('email');
            $table->string('jalur');
            $table->string('gelombang');
            $table->string('status')->default('draft'); 
            $table->string('pilihan1');
            $table->string('pilihan2')->nullable();
            $table->string('pilihan3')->nullable();
            $table->decimal('nilai', 5, 2)->nullable();
            $table->string('kelulusan')->nullable(); 
            $table->string('pilihan_diterima')->nullable();

            $table->timestamps();

            $table->foreign('email')
                ->references('email')->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_pendaftar');
    }
};