<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('idpembayaran');
            $table->foreignId('idpendaftar')
                ->constrained('data_pendaftar', 'idpendaftar')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('status')->default('pending'); // pending, lunas, gagal
            $table->unsignedInteger('total');
            $table->string('bank');
            $table->string('metode'); // transfer, VA, e-wallet
            $table->string('bukti')->nullable();
            $table->dateTime('tanggal_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};