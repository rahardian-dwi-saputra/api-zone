<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use App\Http\Requests\UserRequest;
use App\Models\Customer;

class UserController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (request()->ajax()){
            $user = User::select('id','name','username','email','is_admin')->where('id','!=',1);
            return Datatables::of($user)
                    ->addIndexColumn()
                    ->addColumn('role', function($row){ 
                        if($row->is_admin == 1)
                            return 'admin';
                        else
                            return 'user';

                    })
                    ->removeColumn('is_admin')
                    ->addColumn('action', function($row){
     
                          $actionBtn = '<a href="/user/'.$row->id.'" class="btn btn-primary btn-sm" title="Detail"><i class="fa fa-eye"></i></a> <a href="/user/'.$row->id.'/edit" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a> <a href="'.$row->id.'" class="btn btn-danger btn-sm" id="hapus" title="Hapus"><i class="fa fa-trash"></i></a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('backend.user.create', ['title' => 'Tambah Data User API Baru']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request){

        $validatedData = $request->safe()->merge([
            'is_admin' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        User::create($validatedData->all());
        return redirect('/user')->with('success','Data User API Baru Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user){
        return view('backend.user.show', ['data' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user){
        return view('backend.user.edit', [
            'title' => 'Edit Data Pengguna',
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user){
        
        if($request->password_baru != null){
            $validatedData = $request->safe()->merge([
                'is_admin' => $request->role,
                'password' => bcrypt($request->password_baru),
            ]);
        }else{
            $validatedData = $request->safe()->merge(['is_admin' => $request->role]);
        }

        User::find($user->id)->update($validatedData->all());
        return redirect('/user')->with('success','Data Pengguna Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user){
        if(!in_array($user->id, array(1,2))){

            $user->tokens()->delete();
            Customer::where('user_id', $user->id)->delete();
            $delete = User::destroy($user->id);
            if($delete){
                return response()->json([
                    'success' => true,
                    'message' => 'Data Pengguna berhasil dihapus',
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Data Pengguna gagal dihapus, coba sekali lagi',
                ]);
            }

        }else{
           return response()->json([
                'success' => false,
                'message' => 'Data Pengguna tidak dapat dihapus',
            ]); 
        }
    }
}
