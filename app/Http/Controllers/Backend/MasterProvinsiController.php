<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use DataTables;
use App\Models\Provinsi;
use Validator;

class MasterProvinsiController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (request()->ajax()){ 
            $data = Provinsi::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                          $actionBtn = '<a href="'.$row->id.'" class="btn btn-warning btn-sm" id="edit"><i class="fa fa-edit"></i> Edit</a> <a href="'.$row->id.'" class="btn btn-danger btn-sm" id="hapus"><i class="fa fa-trash"></i> Hapus</a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.master_provinsi'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'nama_provinsi' => 'required|regex:/^[a-zA-Z\s]*$/'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all(),
            ]);
        }

        $n_data = Provinsi::count();
        if($n_data == 0){
            $request->merge(['id' => 'P01']);
        }else{
            $last_id = Provinsi::max('id');
            $next_id = ((int)str_replace('P', '', $last_id))+1;
            $request->merge(['id' => 'P'.sprintf("%02s", $next_id)]);
        }

        $provinsi = Provinsi::create($request->all());
        if($provinsi){
            return response()->json([
                'success' => true,
                'message' => 'Data Provinsi berhasil diinput',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Provinsi gagal diinput, coba sekali lagi',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Provinsi $dataprovinsi){
        if(empty($dataprovinsi)){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }else{
            return response()->json([
                'success' => true,
                'data' => $dataprovinsi
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provinsi $dataprovinsi){
        
        $validator = Validator::make($request->all(), [
            'nama_provinsi' => 'required|regex:/^[a-zA-Z\s]*$/',
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all(),
            ]);
        }
        Provinsi::find($dataprovinsi->id)->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Provinsi berhasil diedit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provinsi $dataprovinsi){
        $delete = Provinsi::destroy($dataprovinsi->id);
        if($delete){
            return response()->json([
                'success' => true,
                'message' => 'Data Provinsi berhasil dihapus',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Provinsi gagal dihapus, coba sekali lagi',
            ]);
        }
    }
}
