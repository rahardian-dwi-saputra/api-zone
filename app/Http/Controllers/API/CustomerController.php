<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Resources\Customer as CustomerResource;
use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if(Gate::allows('isAdmin')){
            if(Customer::count() > 0){
                $customers = Customer::with(['provinsi','kota','kecamatan','user'])->get();
                return $this->sendResponse(CustomerResource::collection($customers), 'Berhasil menarik data customer');
            }else
                return $this->sendError('Data tidak ditemukan');
        }else{
            $customers = Customer::with(['provinsi','kota','kecamatan','user'])->where('user_id',$request->user()->id);
            if($customers->exists()){
                return $this->sendResponse(CustomerResource::collection($customers->get()), 'Berhasil menarik data customer');
            }else{
                return $this->sendError('Data tidak ditemukan');
            }
        }
    }

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
        return $this->sendResponse(new CustomerResource($customer), 'Berhasil membuat data customer');
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
