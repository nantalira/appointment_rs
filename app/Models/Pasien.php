<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pasien extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $table = 'pasien';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'id_akun',
        'alamat',
        'no_ktp',
        'no_hp',
        'no_rm'
    ];

    public function auth(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'id_akun', 'id');
    }
}
