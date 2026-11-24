<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'idpembayaran';

    protected $fillable = [
        'idpendaftar',
        'status',
        'total',
        'bank',
        'metode',
        'bukti',
        'tanggal_pembayaran',
    ];

    protected $casts = [
        'tanggal_pembayaran' => 'datetime',
    ];

    public function pendaftar(): BelongsTo
    {
        return $this->belongsTo(DataPendaftar::class, 'idpendaftar', 'idpendaftar');
    }
}

