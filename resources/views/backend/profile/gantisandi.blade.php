@extends('backend/template/main')
@section('title','Ganti Password')
@section('container')

<div id="page-wrapper">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">Ganti Password</h1>
         </div>  
      </div>
      <div class="row">
         <div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">
                  Ganti Password
               </div>
               <div class="panel-body">

                  @if(session()->has('success'))
                     <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                  @endif
 
                  <div class="row">
                    	<div class="col-lg-8">
                    			
                    		<form action="/gantisandi" method="post">
                    			@csrf
                           @method('put')
                           <div class="form-group row @error('old_password') has-error @enderror">
                              <label for="old_password" class="col-sm-4 col-form-label">
                                 Password Saat ini <span style="color:red;">*</span>
                              </label>
                              <div class="col-sm-5">
                                 <div class="input-group">
                                    <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Password saat ini" autofocus value="{{ old('old_password') }}">

                                    <span class="input-group-btn">
                                       <button class="btn btn-default reveal" type="button" data-id="old_password">
                                          <i class="glyphicon glyphicon-eye-close"></i>
                                       </button>
                                    </span>
                                 </div>
                                 @error('old_password')
                                    <small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
                              </div>
                           </div>

                           <div class="form-group row @error('new_password') has-error @enderror">
                              <label for="new_password" class="col-sm-4 col-form-label">
                                 Password baru <span style="color:red;">*</span>
                              </label>
                              <div class="col-sm-5">
                                 <div class="input-group">
                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Password baru" autofocus value="{{ old('new_password') }}">

                                    <span class="input-group-btn">
                                       <button class="btn btn-default reveal" type="button" data-id="new_password">
                                          <i class="glyphicon glyphicon-eye-close"></i>
                                       </button>
                                    </span>
                                 </div>
                                 @error('new_password')
                                    <small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
                              </div>
                           </div>

                           <div class="form-group row @error('new_password_confirmation') has-error @enderror">
                              <label for="new_password_confirmation" class="col-sm-4 col-form-label">
                                 Konfirmasi password baru <span style="color:red;">*</span>
                              </label>
                              <div class="col-sm-5">
                                 <div class="input-group">
                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Konfirmasi password baru" autofocus value="{{ old('new_password_confirmation') }}">

                                    <span class="input-group-btn">
                                       <button class="btn btn-default reveal" type="button" data-id="new_password_confirmation">
                                          <i class="glyphicon glyphicon-eye-close"></i>
                                       </button>
                                    </span>
                                 </div>
                                 @error('confirm_password')
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
      									<a href="javascript: history.go(-1)" class="btn btn-success">
                                        <i class="fa fa-arrow-left fa-fw"></i> Kembali
                                    </a>
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
   $(function(){ 

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