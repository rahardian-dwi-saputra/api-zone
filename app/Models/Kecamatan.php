<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model{
    use HasFactory;

    protected $table = 'kecamatan';
    protected $keyType = 'string';
    public $timestamps = false;  
    protected $fillable = [
        'id', 'id_kota','nama_kecamatan'
    ];
}
