<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Resources\Customer as CustomerResource;
use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller{

    /**
     * @OA\Get(
     *   path="/api/customers",
     *   operationId="index",
     *   tags={"Customer"},
     *   security={{"bearer":{}}},
     *   summary="Mendapatkan Daftar Customer",
     *   description="Menampilkan semua daftar customer",
     *   @OA\Response(
     *      response=200,
     *      description="Successful Operation",        
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
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   )
     * )
     */
    public function index(Request $request){
        if(Gate::allows('isAdmin')){
            if(Customer::count() > 0){
                $customers = Customer::with(['provinsi','kota','kecamatan','user'])->get();
                return response()->json([
                    'success' => true,
                    'status_code' => Response::HTTP_OK,
                    'data' => CustomerResource::collection($customers),
                    'message' => 'Berhasil menarik data customer'
                ]);
            }else{
                return response()->json([
                    'success' => false, 
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }
        }else{
            $customers = Customer::with(['provinsi','kota','kecamatan','user'])->where('user_id',$request->user()->id);
            if($customers->exists()){
                return response()->json([
                    'success' => true,
                    'status_code' => Response::HTTP_OK,
                    'data' => CustomerResource::collection($customers->get()),
                    'message' => 'Berhasil menarik data customer'
                ]);
            }else{
                return response()->json([
                    'success' => false, 
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }
        }
    }

    /**
     * @OA\Post(
     *  path="/api/customers",
     *  operationId="store",
     *  tags={"Customer"},
     *  security={{"bearer":{}}},
     *  summary="Simpan Data Customer",
     *  description="Menyimpan data customer",
     *  @OA\RequestBody(
     *      description="Data Customer",
     *      required=true,
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="nama",
     *                  description="Nama Customer",
     *                  type="string",
     *                  example="Dummy Customer"
     *              ),
     *              @OA\Property(
     *                  property="nomor_telepon",
     *                  description="Nomor Telepon Customer",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  description="Email Customer",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="alamat",
     *                  description="Alamat Customer", 
     *                  type="text"
     *              ),
     *              @OA\Property(
     *                  property="provinsi_id",
     *                  description="id provinsi dari Alamat Customer",  
     *                  type="string",
     *                  example="P07"
     *              ),
     *              @OA\Property(
     *                  property="kota_id",
     *                  description="id kota atau kabupaten dari Alamat Customer",  
     *                  type="string",
     *                  example="K00007"
     *              ),
     *              @OA\Property(
     *                  property="kecamatan_id",
     *                  description="id kecamatan dari Alamat Customer", 
     *                  type="string",
     *                  example="D00001932"
     *              ),
     *              required={"nama","nomor_telepon", "email", "provinsi_id", "kota_id", "kecamatan_id"},
     *          ),
     *      ),
     * ),
     * @OA\Response(
     *      response=200,
     *      description="Stored Successfully",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     * ),
     * @OA\Response(
     *      response=400, 
     *      description="Invalid Input"
     * ),
     * @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     * ),
     * @OA\Response(
     *      response=422,
     *      description="Unprocessable Entity",
     * )
     * )
     */
    public function store(StoreCustomerRequest $request){

        $validatedData = $request->safe()->merge([
            'nama_pelanggan' => $request->nama,
            'alamat' => $request->alamat,
            'user_id' => auth()->user()->id,
        ]);

        $customer = Customer::create($validatedData->all());
        return response()->json([
            'success' => true,
            'status_code' => Response::HTTP_OK,
            'data' => new CustomerResource($customer),
            'message' => 'Berhasil membuat data customer'
        ]);
    }

    /**
     * @OA\GET(
     *   path="/api/customers/{customer}",
     *   operationId="show",
     *   tags={"Customer"},
     *   security={{"bearer":{}}},
     *   summary="Mendapatkan detail Customer",
     *   description="Menampilkan detail data Customer",
     *   @OA\Parameter(
     *       name="customer",
     *       in="path",
     *       required=true,
     *       description="id customer",
     *       @OA\Schema(
     *           type="integer"
     *       )
     *   ),
     *   @OA\Response(
     *       response=200,
     *       description="Successful Operation",
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
    public function show(Customer $customer){
        if (is_null($customer)) {
            return response()->json([
                'success' => false, 
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $response = Gate::inspect('view', $customer);
        if ($response->allowed()){
            return response()->json([
                'success' => true,
                'status_code' => Response::HTTP_OK,
                'data' => new CustomerResource($customer),
                'message' => 'Berhasil mengambil data customer'
            ]);
        }else{
            return response()->json([
                'success' => false, 
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * @OA\Put(
     *  path="/api/customers/{customer}",
     *  operationId="update",
     *  tags={"Customer"},
     *  security={{"bearer":{}}},
     *  summary="Edit Data Customer",
     *  description="Mengedit data customer",
     *  @OA\Parameter(
     *      name="customer",
     *      in="path",
     *      description="id customer",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *  ),
     *  @OA\RequestBody(
     *      description="Update Data Customer",
     *      required=true,
     *      @OA\MediaType(
     *          mediaType="application/x-www-form-urlencoded",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="nama",
     *                  description="Nama Customer",
     *                  type="string",
     *                  example="Dummy Update Customer"
     *              ),
     *              @OA\Property(
     *                  property="nomor_telepon",
     *                  description="Nomor Telepon Customer",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  description="Email Customer",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="alamat",
     *                  description="Alamat Customer", 
     *                  type="text"
     *              ),
     *              @OA\Property(
     *                  property="provinsi_id",
     *                  description="id provinsi dari Alamat Customer",  
     *                  type="string",
     *                  example="P10"
     *              ),
     *              @OA\Property(
     *                  property="kota_id",
     *                  description="id kota atau kabupaten dari Alamat Customer",  
     *                  type="string",
     *                  example="K00379"
     *              ),
     *              @OA\Property(
     *                  property="kecamatan_id",
     *                  description="id kecamatan dari Alamat Customer", 
     *                  type="string",
     *                  example="D00001820"
     *              ),
     *              required={"nama","nomor_telepon", "email", "provinsi_id", "kota_id", "kecamatan_id"},
     *          ),
     *      ),
     * ),
     * @OA\Response(
     *      response=200,
     *      description="Updated Successfully",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     * ),
     * @OA\Response(
     *      response=400, 
     *      description="Invalid Input"
     * ),
     * @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     * ),
     * @OA\Response(
     *      response=422,
     *      description="Unprocessable Entity",
     * )
     * )
     */
    public function update(StoreCustomerRequest $request, Customer $customer){

        $validatedData = $request->safe()->merge([
            'nama_pelanggan' => $request->nama,
            'alamat' => $request->alamat
        ]);

        $customer->update($validatedData->all());
        return response()->json([
            'success' => true,
            'status_code' => Response::HTTP_OK,
            'data' => new CustomerResource($customer),
            'message' => 'Berhasil mengubah data customer'
        ]);
    }

    /**
     * @OA\Delete(
     *   path="/api/customers/{customer}",
     *   operationId="destroy",
     *   tags={"Customer"},
     *   security={{"bearer":{}}},
     *   summary="Hapus Customer",
     *   description="Menghapus Data Customer",
     *   @OA\Parameter(
     *      name="customer",
     *      in="path",
     *      description="id customer yang akan dihapus",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *      description="Deleted Successfully",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Invalid id customer"
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found"
     *   )
     * )
     */
    public function destroy(Customer $customer){
        $response = Gate::inspect('delete', $customer);
        if ($response->allowed()) {
            $customer->delete();
            return response()->json([
                'success' => true,
                'status_code' => Response::HTTP_OK,
                'message' => 'Berhasil menghapus data customer'
            ]);
        }else{
            return response()->json([
                'success' => false, 
                'message' => 'Data tidak ditemukan'
            ], 404); 
        }
    }
}
