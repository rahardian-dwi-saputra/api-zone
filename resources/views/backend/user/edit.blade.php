@extends('backend/template/main')
@section('title','User API')
@section('container')
<link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet">
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
                    			
                    		<form action="/datacustomer/{{ $data->id }}" method="post">
                    			@csrf
                           @method('put')
                    			<div class="form-group row @error('nama_pelanggan') has-error @enderror">
    									<label for="nama_pelanggan" class="col-sm-3 col-form-label">
    										Nama Customer <span style="color:red;">*</span>
    									</label>
    									<div class="col-sm-9">
      									<input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Nama Customer" autofocus value="{{ old('nama_pelanggan', $data->nama_pelanggan) }}">
                                 @error('nama_pelanggan')
      										<small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
    									</div>
  									</div>
  									<div class="form-group row @error('nomor_telepon') has-error @enderror">
    									<label for="nomor_telepon" class="col-sm-3 col-form-label">
    										Nomor Telepon <span style="color:red;">*</span>
    									</label>
    									<div class="col-sm-3">
      									<input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Nomor Telepon" value="{{ old('nomor_telepon', $data->nomor_telepon) }}">
      									@error('nomor_telepon')
                                    <small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
    									</div>
  									</div>
  									<div class="form-group row @error('email') has-error @enderror">
    									<label for="email" class="col-sm-3 col-form-label">
    										Email
    									</label>
    									<div class="col-sm-5">
      									<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email', $data->email) }}">
                                 @error('email')
                                    <small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
    									</div>
  									</div>
  									<div class="form-group row">
    									<label for="alamat" class="col-sm-3 col-form-label">
    										Alamat
    									</label>
    									<div class="col-sm-8">
    										<textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat">{{ old('alamat', $data->alamat) }}</textarea>
    									</div>
  									</div>
  									<div class="form-group row @error('provinsi_id') has-error @enderror">
    									<label for="provinsi_id" class="col-sm-3 col-form-label">
    										Provinsi <span style="color:red;">*</span>
    									</label>
    									<div class="col-sm-5">
    										<select class="form-control" name="provinsi_id" id="provinsi_id">
    											<option value="">-- Pilih --</option>
                                    
    										</select>
                                 @error('provinsi_id')
                                    <small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
    									</div>
  									</div>
  									<div class="form-group row @error('kota_id') has-error @enderror">
    									<label for="kota_id" class="col-sm-3 col-form-label">
    										Kota/Kabupaten <span style="color:red;">*</span>
    									</label>
    									<div class="col-sm-5">
    										<select class="form-control" name="kota_id" id="kota_id">
    											<option value="">-- Pilih --</option>
                                    
    										</select>
                                 @error('kota_id')
                                    <small class="form-text text-danger">
                                       {{ $message }}                               
                                    </small>
                                 @enderror
    									</div>
  									</div>
  									<div class="form-group row @error('kecamatan_id') has-error @enderror">
    									<label for="kecamatan_id" class="col-sm-3 col-form-label">
    										Kecamatan <span style="color:red;">*</span>
    									</label>
    									<div class="col-sm-5">
    										<select class="form-control" name="kecamatan_id" id="kecamatan_id">
    										   <option value="">-- Pilih --</option>
                                    
    										</select>
                                 @error('kecamatan_id')
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
      									<a href="/datacustomer" class="btn btn-default">Kembali</a>
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
<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
<script>
   function get_kota(id){

      $.ajax({ 
         url: '/getkota/'+id,
         type: 'GET',
         dataType: 'json',
         success: function(response){
            if(response.data.length > 0){
               $.each(response.data, function(i, item){

                  if(item.id == '{{ old('kota_id', $data->kota_id) }}'){
                     $('#kota_id').append('<option value="'+item.id+'" selected>'+item.nama_kota+'</option>');
                     get_kecamatan(item.id);
                  }else{
                     $('#kota_id').append($('<option>', { 
                        value: item.id,
                        text : item.nama_kota 
                     }));
                  }

               });
            }
         }
      });

   }

   function get_kecamatan(id){

      $.ajax({ 
         url: '/getkecamatan/'+id,
         type: 'GET',
         dataType: 'json',
         success: function(response){
            if(response.data.length > 0){
               $.each(response.data, function(i, item){

                  if(item.id == '{{ old('kecamatan_id', $data->kecamatan_id) }}'){
                     $('#kecamatan_id').append('<option value="'+item.id+'" selected>'+item.nama_kecamatan+'</option>');
                  }else{
                     $('#kecamatan_id').append($('<option>', { 
                        value: item.id,
                        text : item.nama_kecamatan 
                     }));
                  }
           
               });
            }
         }
      });

   }


	$(function (){

      //list provinsi
      $.ajax({ 
         url: '/getprovinsi',
         type: 'GET',
         dataType: 'json',
         success: function(response){

            $.each(response.data, function(i, item){
               if(item.id == '{{ old('provinsi_id', $data->provinsi_id) }}'){

                  $('#provinsi_id').append('<option value="'+item.id+'" selected>'+item.nama_provinsi+'</option>');
                  get_kota(item.id);

               }else{
                  $('#provinsi_id').append($('<option>', { 
                     value: item.id,
                     text : item.nama_provinsi 
                  }));
               }

            });
         }
      });

		$('#provinsi_id').select2();
		$('#kota_id').select2();
		$('#kecamatan_id').select2();

		$('#provinsi_id').change(function(){
         var id = $(this).val();
         $('#kota_id option').remove(); 
         $('#kota_id').append($('<option>', { 
            value: '',
            text : 'Silahkan Pilih' 
         }));
         $('#kecamatan_id option').remove(); 
         $('#kecamatan_id').append($('<option>', { 
            value: '',
            text : 'Silahkan Pilih' 
         }));
         if(id != ''){
            get_kota(id);
         }
      });

      $('#kota_id').change(function(){ 
         var id = $(this).val();
         $('#kecamatan option').remove(); 
         $('#kecamatan').append($('<option>', { 
            value: '',
            text : 'Silahkan Pilih' 
         }));

         if(id != ''){
            get_kecamatan(id);
         }
      });

	});
</script>

@endsection