@extends('backend/template/main')
@section('title','Akun Saya')
@section('container')

<div id="page-wrapper">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">Akun Saya</h1>
         </div>  
      </div>
      <div class="row">
         <div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">
                  Ubah Data Profil
               </div>
               <div class="panel-body">
                  
                  <div class="row">
                    	<div class="col-lg-8">
                    			
                    		<form action="/profil" method="post">
                    			@csrf
                           @method('put')
                           <div class="form-group row @error('name') has-error @enderror">
                              <label for="name" class="col-sm-3 col-form-label">
                                 Nama <span style="color:red;">*</span>
                              </label>
                              <div class="col-sm-5">
                                 <input type="text" class="form-control" id="name" name="name" placeholder="Nama" autofocus value="{{ old('name', auth()->user()->name) }}">
                                 @error('name')
                                    <small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
                              </div>
                           </div>

                           <div class="form-group row @error('username') has-error @enderror">
                              <label for="username" class="col-sm-3 col-form-label">
                                 Username <span style="color:red;">*</span>
                              </label>
                              <div class="col-sm-5">
                                 <input type="text" class="form-control" id="username" name="username" placeholder="Username" autofocus value="{{ old('username', auth()->user()->username) }}">
                                 @error('username')
                                    <small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
                              </div>
                           </div>

                           <div class="form-group row @error('email') has-error @enderror">
                              <label for="email" class="col-sm-3 col-form-label">
                                 Email <span style="color:red;">*</span>
                              </label>
                              <div class="col-sm-5">
                                 <input type="email" class="form-control" id="email" name="email" placeholder="Email" autofocus value="{{ old('email', auth()->user()->email) }}">
                                 @error('email')
                                    <small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
                              </div>
                           </div>

  									<div class="form-group row">
    									<div class="col-sm-10">
      									<button type="submit" class="btn btn-primary">Simpan</button>
      									&nbsp;
      									<a href="/profil" class="btn btn-default">Kembali</a>
    									</div>
  									</div>
                    		</form>
                    			
                    	</div>
                  </div>
               </div>
        		</div>
        	</div>
      </div>
   </div>
</div>
@endsection