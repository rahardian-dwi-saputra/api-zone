<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Http\Response;
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
     *   path="/api/getprovinsi",
     *   operationId="getListProvinsi",
     *   tags={"Provinsi"},
     *   security={
     *    {"passport": {}},
     *   },
     *   summary="Mendapatkan Daftar Provinsi",
     *   description="Menampilkan semua daftar provinsi",
     *   @OA\Response(
     *      response=200,
     *      description="Successful operation",        
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     * )
     */
    public function daftar_provinsi(){
        return response()->json([
            'success' => true,
            'status_code' => Response::HTTP_OK,
            'data' => ProvinsiResource::collection(Provinsi::all()),
            'message' => 'Berhasil menarik data provinsi'
        ]);
    }

    /**
     * @OA\GET(
     *   path="/api/getkota/{provinsi_id}",
     *   operationId="getListKota",
     *   tags={"Kota"},
     *   security={
     *    {"passport": {}},
     *   },
     *   summary="Mendapatkan daftar Kota dan Kabupaten",
     *   description="Menampilkan daftar kota dan kabupaten di suatu provinsi",
     *   @OA\Parameter(
     *       name="provinsi_id",
     *       in="path",
     *       required=true,
     *       @OA\Schema(
     *           type="string"
     *       )
     *   ),
     *   @OA\Response(
     *       response=200,
     *       description="Successful operation",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *       )
     *   ),
     *   @OA\Response(
     *       response=401,
     *       description="Unauthenticated",
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   )
     * )
     */
    public function daftar_kota(Request $request){
    	if(!empty($request->provinsi_id)){
    		$kota = Kota::where('id_provinsi', $request->provinsi_id);
    		if($kota->exists()){
                return response()->json([
                    'success' => true,
                    'status_code' => Response::HTTP_OK,
                    'data' => KotaResource::collection($kota->get()),
                    'message' => 'Berhasil menarik data kota dan kabupaten'
                ]);
    		}else{
                return response()->json([
                    'success' => false, 
                    'message' => 'Data tidak ditemukan'
                ], 404);
    		}
    	}else{
            return response()->json([
                'success' => false, 
                'message' => 'Parameter provinsi_id tidak boleh kosong'
            ], 404);
    	}
    }

    /**
     * @OA\GET(
     *   path="/api/getkecamatan/{id}",
     *   operationId="getListKecamatan",
     *   tags={"Kecamatan"},
     *   security={
     *    {"passport": {}},
     *   },
     *   summary="Mendapatkan daftar Kecamatan",
     *   description="Menampilkan daftar kecamatan di suatu kota atau kabupaten",
     *   @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       @OA\Schema(
     *           type="string"
     *       )
     *   ),
     *   @OA\Response(
     *       response=200,
     *       description="Successful operation",
     *       @OA\MediaType(
     *           mediaType="application/json",
     *       )
     *   ),
     *   @OA\Response(
     *       response=401,
     *       description="Unauthenticated",
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   )
     * )
     */
    public function daftar_kecamatan(Request $request){
    	if(!empty($request->id)){
            $kecamatan = Kecamatan::where('id_kota', $request->id);
            if($kecamatan->exists()){
                return response()->json([
                    'success' => true,
                    'status_code' => Response::HTTP_OK,
                    'data' => KecamatanResource::collection($kecamatan->get()),
                    'message' => 'Berhasil menarik data kecamatan'
                ]);
            }else{
                return response()->json([
                    'success' => false, 
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }
        }else{
            return response()->json([
                'success' => false, 
                'message' => 'Parameter id tidak boleh kosong'
            ], 404);
        }
    }
}
