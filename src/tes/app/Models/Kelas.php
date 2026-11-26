<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    // Eksplisit, karena pluralisasi otomatis Laravel untuk kata "kelas" tidak bisa diandalkan
    protected $table = 'kelas';

    protected $fillable = [
        'nama',
        'keterangan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('aktif', true);
    }

    public function pendaftar(): HasMany
    {
        return $this->hasMany(DataPendaftar::class, 'kelas_id', 'id');
    }
}
