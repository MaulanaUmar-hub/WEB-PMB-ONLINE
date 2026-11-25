<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DataPendaftar extends Model
{
    protected $table = 'data_pendaftar';
    protected $primaryKey = 'idpendaftar';

    protected $fillable = [
        'email',
        'jalur',
        'kelas',
        'gelombang',
        'status',
        'sumber_info',
        'pilihan1',
        'pilihan2',
        'pilihan3',
        'nilai',
        'kelulusan',
        'pilihan_diterima',
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function biodata(): HasOne
    {
        return $this->hasOne(Biodata::class, 'idpendaftar', 'idpendaftar');
    }

    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'idpendaftar', 'idpendaftar');
    }

    public function berkas(): HasMany
    {
        return $this->hasMany(Berkas::class, 'idpendaftar', 'idpendaftar');
    }
}
