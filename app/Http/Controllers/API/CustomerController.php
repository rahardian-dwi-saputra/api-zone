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
     *   operationId="getListCustomer",
     *   tags={"Customer"},
     *   security={
     *    {"passport": {}},
     *   },
     *   summary="Mendapatkan Daftar Customer",
     *   description="Menampilkan semua daftar customer",
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
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   )
     * )
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * path="/api/customers",
     * operationId="Register",
     * tags={"Customer"},
     * security={
     *   {"passport": {}},
     * },
     * summary="Simpan Data Customer",
     * description="Menyimpan data customer",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"nama","nomor_telepon", "email", "provinsi_id", "kota_id", "kecamatan_id"},
     *               @OA\Property(property="nama", type="string"),
     *               @OA\Property(property="nomor_telepon", type="string"),
     *               @OA\Property(property="email", type="string"),
     *               @OA\Property(property="alamat", type="text")
     *               @OA\Property(property="provinsi_id", type="string")
     *               @OA\Property(property="kota_id", type="string")
     *               @OA\Property(property="kecamatan_id", type="string")
     *            ),
     *         ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Stored Successfully",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *      ),
     *      @OA\Response(
     *          response=400, 
     *          description="Bad request"
     *      ),
     *      @OA\Response(
     *          response=404, 
     *          description="Resource Not Found"
     *      )
     * )
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer){
        if (is_null($customer)) {
            return $this->sendError('Data tidak ditemukan');
        }

        $response = Gate::inspect('view', $customer);
        if ($response->allowed()){
            return $this->sendResponse(new CustomerResource($customer), 'Berhasil mengambil data customer');
        }else{
            return $this->sendError('Data tidak ditemukan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCustomerRequest $request, Customer $customer){

        $customer->nama_pelanggan = $request->nama;
        $customer->nomor_telepon = $request->nomor_telepon;
        $customer->email = $request->email;
        $customer->alamat = $request->alamat;
        $customer->provinsi_id = $request->provinsi_id;
        $customer->kota_id = $request->kota_id;
        $customer->kecamatan_id = $request->kecamatan_id;
        $customer->save();

        return $this->sendResponse(new CustomerResource($customer), 'Berhasil mengubah data customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer){
        $response = Gate::inspect('delete', $customer);
        if ($response->allowed()) {
            $customer->delete();
            return $this->sendResponse([], 'Berhasil menghapus data customer');
        }else{
           return $this->sendError('Data tidak ditemukan'); 
        }
    }
}
