<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Http\Resources\Provinsi as ProvinsiResource;
use App\Models\Kota;
use App\Http\Resources\Kota as KotaResource;
use App\Models\Kecamatan;
use App\Http\Resources\Kecamatan as KecamatanResource;

class ZoneController extends Controller{
    
    /**
     * @OA\Get(
     *      path="/api/getprovinsi",
     *      operationId="getListProvinsi",
     *      tags={"Provinsi"},
     * security={
     *  {"passport": {}},
     *   },
     *      summary="Mendapatkan Daftar Provinsi",
     *      description="Menampilkan semua daftar provinsi",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",        
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function daftar_provinsi(){
        $data_provinsi = Provinsi::all();
        return response()->json([
            'success' => true,
            'status_code' => Response::HTTP_OK,
            'data' => ProvinsiResource::collection($data_provinsi),
            'message' => 'Berhasil menarik data provinsi'

        ]);
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
