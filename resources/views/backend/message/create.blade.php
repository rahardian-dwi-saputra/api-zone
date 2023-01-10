@extends('backend/template/main')
@section('title','Template Pesan')
@section('container')
<link href="{{ asset('assets/trixeditor/trix.css') }}" rel="stylesheet">
<style type="text/css">
   trix-toolbar [data-trix-button-group="file-tools"]{
      display:none;
   }
</style>
<div id="page-wrapper">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">Template Pesan</h1>
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
                     Semua field wajib diisi
                  </div>
                  <br>
                  <div class="row">
                    	<div class="col-lg-8">
                    			
                    		<form action="/message" method="post">
                    		   @csrf
                    			<div class="form-group row @error('type_message') has-error @enderror">
    									<label for="type_message" class="col-sm-3 col-form-label">
    										Type Pesan <span style="color:red;">*</span>
    									</label>
    									<div class="col-sm-9">
      									<input type="text" class="form-control" id="type_message" name="type_message" placeholder="Type Pesan" autofocus value="{{ old('type_message') }}">
                                 @error('type_message')
      										<small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
    									</div>
  									</div>
  									
  									<div class="form-group row">
    									<label for="message" class="col-sm-3 col-form-label">
    										Isi Pesan <span style="color:red;">*</span>
                                 @error('message')
                                    <p class="text-danger" style="font-weight:normal;">{{ $message }}</p>
                                 @enderror
    									</label>

    									<div class="col-sm-9">
                                 <input id="message" type="hidden" name="message" value="{{ old('message') }}">
      									<trix-editor input="message"></trix-editor> 
    									</div>
  									</div>
  							
  									<div class="form-group row">
    									<div class="col-sm-10">
      									<button type="submit" class="btn btn-primary">
                                    Simpan
                                 </button>
      									&nbsp;
      									<a href="/message" class="btn btn-default">Kembali</a>
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
<script src="{{ asset('assets/trixeditor/trix.js') }}"></script>
<script>
	document.addEventListener('trix-file-accept', function(e){
      e.preventDefault();
   });
</script>

@endsection