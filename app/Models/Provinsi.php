<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model{
    use HasFactory;

    protected $table = 'provinsi';
    protected $keyType = 'string';
    public $timestamps = false;  
    protected $fillable = [
        'id', 'nama_provinsi'
    ];

    
    public function customers(){
        return $this->hasMany(Customer::class);
    }
}