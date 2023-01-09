<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use DataTables;
use App\Models\Kota;
use App\Models\Provinsi;
use Validator;

class MasterKotaController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (request()->ajax()){
            if(!empty(request()->provinsi)){
               $data = Kota::select('kota.id', 'provinsi.nama_provinsi','kota.nama_kota')->join('provinsi', 'kota.id_provinsi', '=', 'provinsi.id')->where('provinsi.nama_provinsi', request()->provinsi)->get();
            }else{
               $data = Kota::join('provinsi', 'kota.id_provinsi', '=', 'provinsi.id')->get(['kota.id', 'provinsi.nama_provinsi','kota.nama_kota']);
            }
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                          $actionBtn = '<a href="'.$row->id.'" class="btn btn-warning btn-sm" id="edit"><i class="fa fa-edit"></i> Edit</a> <a href="'.$row->id.'" class="btn btn-danger btn-sm" id="hapus"><i class="fa fa-trash"></i> Hapus</a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.master_kota', [
            'list_provinsi' => Provinsi::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'nama_kota' => 'required|regex:/^[a-zA-Z\s]*$/',
            'provinsi' => 'required|exists:provinsi,id'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all(),
            ]);
        }

        $n_data = Kota::count();
        if($n_data == 0){
            $request->merge(['id' => 'K00001']);
        }else{
            $last_id = Kota::max('id');
            $next_id = ((int)str_replace('K', '', $last_id))+1;
            $request->merge(['id' => 'K'.sprintf("%05s", $next_id)]);
        }

        $request->merge(['id_provinsi' => $request->provinsi]);

        $kota = Kota::create($request->all());
        if($kota){
            return response()->json([ 
                'success' => true,
                'message' => 'Data Kota berhasil diinput',
            ]);
        }else{
            return response()->json([ 
                'success' => false,
                'message' => 'Data Kota gagal diinput, coba sekali lagi',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kota $datakotum){
        if(empty($datakotum)){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }else{
            return response()->json([
                'success' => true,
                'data' => $datakotum
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
    public function update(Request $request, Kota $datakotum){

        $validator = Validator::make($request->all(), [
            'nama_kota' => 'required|regex:/^[a-zA-Z\s]*$/',
            'provinsi' => 'required|exists:provinsi,id'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all(),
            ]);
        }

        $request->merge(['id_provinsi' => $request->provinsi]);

        Kota::find($datakotum->id)->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Kota berhasil diedit'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kota $datakotum){
        $delete = Kota::destroy($datakotum->id);
        if($delete){
            return response()->json([
                'success' => true,
                'message' => 'Data Kota berhasil dihapus',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Kota gagal dihapus, coba sekali lagi',
            ]);
        }
    }
}
