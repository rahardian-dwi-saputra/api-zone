@extends('backend/template/main')
@section('title','User API')
@section('container')
<div id="page-wrapper">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">User API</h1>
         </div>  
      </div>
      <div class="row">
         <div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">
                  {{ $title }}
               </div>
               <div class="panel-body">
                  <div class="alert alert-warning">
                     Tanda <span style="color:red;">*</span> Wajib diisi
                  </div>
                  <br>
                  <div class="row">
                    	<div class="col-lg-8">
                    			
                    		<form action="/user/{{ $data->id }}" method="post">
                    			@csrf
                           @method('put')
                           <div class="form-group row @error('name') has-error @enderror">
                              <label for="name" class="col-sm-4 col-form-label">
                                 Nama <span style="color:red;">*</span>
                              </label>
                              <div class="col-sm-5">
                                 <input type="text" class="form-control" id="name" name="name" placeholder="Nama" autofocus value="{{ old('name', $data->name) }}">
                                 @error('name')
                                    <small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="username" class="col-sm-4 col-form-label">
                                 Username
                              </label>
                              <div class="col-sm-5">
                                 <input type="text" class="form-control" placeholder="Username" value="{{ $data->username }}" readonly>
                              </div>
                           </div>
                           <div class="form-group row @error('email') has-error @enderror">
                              <label for="email" class="col-sm-4 col-form-label">
                                 Email <span style="color:red;">*</span>
                              </label>
                              <div class="col-sm-5">
                                 <input type="email" class="form-control" id="email" name="email" placeholder="Email" autofocus value="{{ old('email', $data->email) }}">
                                 @error('email')
                                    <small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
                              </div>
                           </div>
                           <div class="form-group row @error('role') has-error @enderror">
                              <label for="role" class="col-sm-4 col-form-label">
                                 Role <span style="color:red;">*</span>
                              </label>
                              <div class="col-sm-5">
                                 <select class="form-control" name="role" id="role">
                                    <option value="">-- Pilih --</option>
                                    <option value="1" @if(old('role', $data->is_admin) == 1) selected @endif>Admin</option>
                                    <option value="0" @if(old('role', $data->is_admin) == 0) selected @endif>User</option>
                                 </select>
                                 @error('role')
                                    <small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
                              </div>
                           </div>
                           <div class="form-group row @error('password_baru') has-error @enderror">
                              <label for="password_baru" class="col-sm-4 col-form-label">
                                 Password baru
                              </label>
                              <div class="col-sm-5">
                                 <div class="input-group">
                                    <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Password baru" autofocus value="{{ old('password_baru') }}">

                                    <span class="input-group-btn">
                                       <button class="btn btn-default reveal" type="button" data-id="password_baru">
                                          <i class="glyphicon glyphicon-eye-close"></i>
                                       </button>
                                    </span>
                                 </div>
                                 @error('password_baru')
                                    <small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
                              </div>
                           </div>

                           <div class="form-group row @error('password_baru_confirmation') has-error @enderror">
                              <label for="password_baru_confirmation" class="col-sm-4 col-form-label">
                                 Konfirmasi password baru
                              </label>
                              <div class="col-sm-5">
                                 <div class="input-group">
                                    <input type="password" class="form-control" id="password_baru_confirmation" name="password_baru_confirmation" placeholder="Konfirmasi password baru" autofocus value="{{ old('password_baru_confirmation') }}">

                                    <span class="input-group-btn">
                                       <button class="btn btn-default reveal" type="button" data-id="password_baru_confirmation">
                                          <i class="glyphicon glyphicon-eye-close"></i>
                                       </button>
                                    </span>
                                 </div>
                                 @error('password_baru_confirmation')
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
      									<a href="/user" class="btn btn-default">Kembali</a>
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

<script>
	$(function (){
      $(".reveal").on('click',function(){
         if($(this).find('i').attr('class').indexOf('glyphicon-eye-close') != -1){
            $(this).find('i').removeClass('glyphicon-eye-close');
            $(this).find('i').addClass('glyphicon-eye-open');
            $('#'+$(this).attr('data-id')).attr('type','text');
         }else{
            $(this).find('i').removeClass('glyphicon-eye-open');
            $(this).find('i').addClass('glyphicon-eye-close');
            $('#'+$(this).attr('data-id')).attr('type','password');
         }
      });
      
	});
</script>

@endsection