<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Biodata extends Model
{
    protected $table = 'biodata';
    protected $primaryKey = 'idpendaftar';
    public $incrementing = false; // PK = FK ke data_pendaftar, bukan auto increment

    protected $fillable = [
        'idpendaftar',
        'nama',
        'nik',
        'no_kk',
        'tempat_lahir',
        'tanggal_lahir',
        'gender',
        'alamat',
        'no_hp',
        'nisn',
        'asal_sekolah',
        'nama_ayah',
        'nama_ibu',
        'nama_wali',
        'no_hp_wali',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function pendaftar(): BelongsTo
    {
        return $this->belongsTo(DataPendaftar::class, 'idpendaftar', 'idpendaftar');
    }
}
