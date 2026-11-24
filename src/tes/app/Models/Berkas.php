<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berkas extends Model
{
    protected $table = 'berkas'; // tanpa ini Laravel menebak "berkas" jadi "berkases"
    protected $primaryKey = 'idberkas';

    protected $fillable = [
        'idpendaftar',
        'jenis_berkas',
        'file_path',
    ];

    public function pendaftar(): BelongsTo
    {
        return $this->belongsTo(DataPendaftar::class, 'idpendaftar', 'idpendaftar');
    }
}
