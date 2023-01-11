<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use DataTables;
use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Support\Facades\Gate;

use App\Http\Resources\Customer as CustomerResource;

class MasterCustomerController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (request()->ajax()){
            $query_customer = Customer::select('customers.id','nama_pelanggan as nama','nomor_telepon','nama_provinsi','nama_kota')->join('provinsi', 'provinsi.id', '=', 'customers.provinsi_id')->join('kota', 'kota.id', '=', 'customers.kota_id');

            if(!empty(request()->provinsi)){
                $query_customer->where('provinsi_id', request()->provinsi);
            }
            if(!empty(request()->kota)){
                $query_customer->where('kota_id', request()->kota);
            }

            if(Gate::allows('isAdmin')){
                if(!empty(request()->user)){
                    $query_customer->where('user_id', request()->user);
                }
            }else{
                $query_customer->where('user_id', auth()->user()->id);
            }

            $customer = $query_customer->get();

            return Datatables::of($customer)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $actionBtn = '<a href="/datacustomer/'.$row->id.'" class="btn btn-primary btn-sm" title="Detail"><i class="fa fa-eye"></i></a> <a href="/datacustomer/'.$row->id.'/edit" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a> <a href="'.$row->id.'" class="btn btn-danger btn-sm" id="hapus" title="Hapus"><i class="fa fa-trash"></i></a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        if(Gate::allows('isAdmin')){
            return view('backend.customer.index',[
                'users' => User::select('id','name')->get()
            ]);
        }else{
            return view('backend.customer.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('backend.customer.create', ['title' => 'Tambah Data Customer Baru']);
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

        Customer::create($validatedData->all());
        return redirect('/datacustomer')->with('success','Data Customer Baru Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $datacustomer){
        $this->authorize('view', $datacustomer);
        return view('backend.customer.show', ['data' => $datacustomer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $datacustomer){
        $this->authorize('update', $datacustomer);

        return view('backend.customer.edit', [
            'title' => 'Edit Data Customer',
            'data' => $datacustomer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCustomerRequest $request, Customer $datacustomer){
       
        $validatedData = $request->safe()->merge([
            'nama_pelanggan' => $request->nama,
            'alamat' => $request->alamat,
        ]);

        Customer::find($datacustomer->id)->update($validatedData->all());
        return redirect('/datacustomer')->with('success','Data Customer Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $datacustomer){
        $response = Gate::inspect('delete', $datacustomer);

        if ($response->allowed()) {
            $delete = Customer::destroy($datacustomer->id);
            if($delete){
                return response()->json([
                    'success' => true,
                    'message' => 'Data Customer berhasil dihapus',
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Data Customer gagal dihapus, coba sekali lagi',
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => $response->message(),
            ]);
        } 
    }
}
