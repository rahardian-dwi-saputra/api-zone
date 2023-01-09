<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $timestamps = false;  
    protected $guarded = ['id'];

    public function provinsi(){
        return $this->belongsTo(Provinsi::class);
    }
    public function kota(){
        return $this->belongsTo(Kota::class);
    }
    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
