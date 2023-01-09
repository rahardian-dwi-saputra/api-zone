<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Http\Resources\Provinsi as ProvinsiResource;
use App\Models\Kota;
use App\Http\Resources\Kota as KotaResource;
use App\Models\Kecamatan;
use App\Http\Resources\Kecamatan as KecamatanResource;

class ZoneController extends BaseController{
    
    public function daftar_provinsi(){
    	return $this->sendResponse(ProvinsiResource::collection(Provinsi::all()), 'Berhasil menarik data provinsi');
    }
    public function daftar_kota(Request $request){
    	if(!empty($request->id)){
    		$kota = Kota::where('id_provinsi', $request->id);
    		if($kota->exists()){	
        		return $this->sendResponse(KotaResource::collection($kota->get()), 'Berhasil menarik data kota dan kabupaten');
    		}else{
    			return $this->sendError('Data tidak ditemukan'); 
    		}
    	}else{
    		return $this->sendError('Parameter id tidak boleh kosong');
    	}
    }
    public function daftar_kecamatan(Request $request){
    	if(!empty($request->id)){
            $kecamatan = Kecamatan::where('id_kota', $request->id);
            if($kecamatan->exists()){    
                return $this->sendResponse(KecamatanResource::collection($kecamatan->get()), 'Berhasil menarik data kecamatan');
            }else{
                return $this->sendError('Data tidak ditemukan'); 
            }
        }else{
            return $this->sendError('Parameter id tidak boleh kosong'); 
        }
    }
}
