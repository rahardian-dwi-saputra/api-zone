<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use DataTables;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use Validator;

class MasterKecamatanController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (request()->ajax()){
            $query_kecamatan = Kecamatan::select('provinsi.nama_provinsi','kota.nama_kota','kecamatan.nama_kecamatan','kecamatan.id')->join('kota', 'kota.id', '=', 'kecamatan.id_kota')->join('provinsi', 'provinsi.id', '=', 'kota.id_provinsi');
            if(!empty(request()->provinsi)){
                $query_kecamatan->where('provinsi.id', request()->provinsi);
            }
            if(!empty(request()->kota)){
                $query_kecamatan->where('kota.id', request()->kota);
            }
            return Datatables::of($query_kecamatan->get())
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                          $actionBtn = '<a href="'.$row->id.'" class="btn btn-warning btn-sm" id="edit"><i class="fa fa-edit"></i> Edit</a> <a href="'.$row->id.'" class="btn btn-danger btn-sm" id="hapus"><i class="fa fa-trash"></i> Hapus</a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('backend.master_kecamatan');
    }
    public function get_provinsi(){
        return response()->json([
            'data' => Provinsi::all()
        ]);
    }
    public function get_kota($id_provinsi=''){
        return response()->json([
            'data' => Kota::select('id','nama_kota')->where('id_provinsi',$id_provinsi)->orderBy('nama_kota', 'asc')->get()
        ]);
    }
    public function get_kecamatan($id_kota=''){ 
        return response()->json([
            'data' => Kecamatan::select('id','nama_kecamatan')->where('id_kota',$id_kota)->orderBy('nama_kecamatan', 'asc')->get()
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
            'kecamatan' => 'required|regex:/^[a-zA-Z\s]*$/',
            'provinsi' => 'required|exists:provinsi,id',
            'kota' => 'required|exists:kota,id'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all(),
            ]);
        }

        $n_data = Kecamatan::count();
        if($n_data == 0){
            $request->merge(['id' => 'D00000001']);
        }else{
            $last_id = Kecamatan::max('id');
            $next_id = ((int)str_replace('D', '', $last_id))+1;
            $request->merge(['id' => 'D'.sprintf("%08s", $next_id)]);
        }

        $kecamatan = Kecamatan::create([
            'id' => $request->id,
            'id_kota' => $request->kota,
            'nama_kecamatan' => $request->kecamatan,
        ]);

        if($kecamatan) {
            return response()->json([
                'success' => true,
                'message' => 'Data Kecamatan berhasil diinput',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Kecamatan gagal diinput, coba sekali lagi',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $kecamatan = Kecamatan::select('provinsi.id as provinsi','kota.id as kota','kecamatan.id','kecamatan.nama_kecamatan')->join('kota', 'kota.id', '=', 'kecamatan.id_kota')->join('provinsi', 'provinsi.id', '=', 'kota.id_provinsi')->where('kecamatan.id', $id);
        if($kecamatan->exists()){
            return response()->json([
                'success' => true,
                'data' => $kecamatan->first(),
                'list_kota' => Kota::select('id','nama_kota')->where('id_provinsi', $kecamatan->first()->provinsi)->get(),

            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
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
    public function update(Request $request, Kecamatan $datakecamatan){
        $validator = Validator::make($request->all(), [
            'kecamatan' => 'required|regex:/^[a-zA-Z\s]*$/',
            'provinsi' => 'required|exists:provinsi,id',
            'kota' => 'required|exists:kota,id',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all(),
            ]);
        }

        Kecamatan::find($datakecamatan->id)->update([
            'id_kota' => $request->kota,
            'nama_kecamatan' => $request->kecamatan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Kecamatan berhasil diedit',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $datakecamatan){
        $delete = Kecamatan::destroy($datakecamatan->id);
        if($delete){
            return response()->json([
                'success' => true,
                'message' => 'Data Kecamatan berhasil dihapus',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Kecamatan gagal dihapus, coba sekali lagi',
            ]);
        }
    }
}
