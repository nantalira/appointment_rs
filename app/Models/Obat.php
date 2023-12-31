<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $table = 'obat';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nama_obat',
        'kemasan',
        'harga',
    ];
}
