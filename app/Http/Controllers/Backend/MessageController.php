<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use DataTables;
use Illuminate\Support\Facades\Gate;

class MessageController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (request()->ajax()){
            $query_message = Message::select('*');

            if(!empty(request()->type)){
                $query_message->where('type_message', request()->type);
            }

            $message = $query_message->get();

            $datatable = Datatables::of($message)->addIndexColumn();

            if(Gate::allows('isAdmin')){
                return $datatable->addColumn('action', function($row){
                          
                        $actionBtn = '<a href="/message/'.$row->id.'/edit" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a> <a href="'.$row->id.'" class="btn btn-danger btn-sm" id="hapus" title="Hapus"><i class="fa fa-trash"></i></a>';
                       
                        return $actionBtn;
                    })
                    ->rawColumns(['action', 'message'])
                    ->make(true);
            }else{
                return $datatable->rawColumns(['message'])->make(true);
            }
        }
        return view('backend.message.index',[
            'type' => Message::select('type_message')->distinct()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('backend.message.create', ['title' => 'Tambah Template Pesan Baru']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validatedData = $request->validate([ 
            'type_message' => 'required',
            'message' => 'required',
        ]);
        Message::create($validatedData);
        return redirect('/message')->with('success','Template pesan baru berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message){
        return view('backend.message.edit', [
            'title' => 'Edit Template Pesan',
            'data' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message){
        $validatedData = $request->validate([ 
            'type_message' => 'required',
            'message' => 'required',
        ]);
        Message::find($message->id)->update($validatedData);
        return redirect('/message')->with('success','Template pesan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message){
        $delete = Message::destroy($message->id);
        if($delete){
            return response()->json([
                'success' => true,
                'message' => 'Template pesan berhasil dihapus',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Template pesan gagal dihapus, coba sekali lagi',
            ]);
        }
    }
}
