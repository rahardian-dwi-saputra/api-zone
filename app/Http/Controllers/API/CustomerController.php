<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Resources\Customer as CustomerResource;
use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Support\Facades\Gate;

class CustomerController extends BaseController{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if(Gate::allows('isAdmin')){
            if(Customer::count() > 0)
                return $this->sendResponse(CustomerResource::collection(Customer::all()), 'Berhasil menarik data customer');
            else
                return $this->sendError('Data tidak ditemukan');
        }else{
            $data = Customer::where('user_id',$request->user()->id);
            if($data->exists()){
                return $this->sendResponse(CustomerResource::collection($data->get()), 'Berhasil menarik data customer');
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
    public function show(StoreCustomerRequest $customer){
        if (is_null($customer)) {
            return $this->sendError('Data tidak ditemukan');
        }
        return $this->sendResponse(new CustomerResource($customer), 'Berhasil mengambil data customer');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCustomerRequest $request, Customer $customer){

        $validatedData = $request->safe()->merge([
            'nama_pelanggan' => $request->nama,
            'alamat' => $request->alamat,
        ]);

        $customer = Customer::find($customer->id)->update($validatedData->all());
        return $this->sendResponse(new CustomerResource($customer), 'Berhasil mengubah data customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer){
        $customer->delete();
        return $this->sendResponse([], 'Berhasil menghapus data customer');
    }
}
