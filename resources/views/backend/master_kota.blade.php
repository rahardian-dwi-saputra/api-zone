@extends('backend/template/main')
@section('title','Data Kota')
@section('container')

<link href="{{ asset('assets/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
<link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet">
<style type="text/css">
	table th, table td:nth-child(1), table td:nth-child(4){
		text-align: center;
	}
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Kota dan Kabupaten</h1>
            </div>  
        </div>
        <div class="row">
        	<div class="col-lg-12">

        		<div class="panel panel-default">
        			<div class="panel-heading">
                        Daftar Data Kota dan Kabupaten
                    </div>
                    <div class="panel-body">
                    	<div class="row">
                    		<div class="col-lg-12">
                    			<button class="btn btn-success" id="plus-button">
                    				<i class="fa fa-plus-circle"></i> Tambah Data
                    			</button>
                    		</div>
                    	</div>
                        <br>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group row">
                                    <label for="list_provinsi" class="col-sm-2 col-form-label">
                                        Provinsi
                                    </label>
                                    <div class="col-sm-7">
                                        <select class="form-control" id="list_provinsi">
                                            <option value="">Semua Provinsi</option>
                                            @foreach ($list_provinsi as $list)
                                                <option value="{{ $list->nama_provinsi }}">{{ $list->nama_provinsi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    	<br>
                    	<div class="row">
                    		<div class="col-lg-12">
                    			<div id="alert-table" class="alert alert-success alert-dismissible" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <p style="display:inline">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                     
                                </div>
                    			<div class="table-responsive">
                    				<table class="table table-striped table-bordered table-hover" id="data-kota">
                    					<thead>
                                    		<tr>
                                        		<th>No</th>
                                        		<th>Nama Kota/Kabupaten</th>
                                                <th>Provinsi Asal</th>
                                        		<th>Action</th>          
                                    		</tr>
                                		</thead>
                                		<tbody></tbody>
                    				</table>
                    			</div>
							</div>
						</div>

                    </div>
        		</div>

        	</div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>

            <form id="form-input">
            	@csrf
            	<input type="hidden" name="method" id="method" value="insert" />
            	<input type="hidden" name="id" id="id" />
            	<div class="modal-body">
                    <div id="alert-modal" class="alert alert-danger alert-dismissible hidden" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p style="display:inline">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
            		<div class="form-group row">
    					<label for="nama_provinsi" class="col-sm-3 col-form-label">
    						Nama Kota <span style="color:red;">*</span>
    					</label>
    					<div class="col-sm-9">
      						<input type="text" class="form-control" id="nama_kota" name="nama_kota" placeholder="Nama Kota">
    					</div>
  					</div>
                    <div class="form-group row">
                        <label for="nama_provinsi" class="col-sm-3 col-form-label">
                            Provinsi Asal <span style="color:red;">*</span>
                        </label>
                        <div class="col-sm-7">
                            <select class="form-control" name="provinsi" id="provinsi">
                                <option value="">Silahkan Pilih</option>
                                @foreach ($list_provinsi as $list)
                                    <option value="{{ $list->id }}">{{ $list->nama_provinsi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            	</div>
            	<div class="modal-footer">
            		<button type="submit" class="btn btn-primary">
            			Simpan
            		</button>
            		<button type="button" class="btn btn-default" data-dismiss="modal">
            			Tutup
            		</button>
            	</div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
            </div>
            <form id="form-hapus">
            	<input type="hidden" name="link" id="link" />
            	<div class="modal-body">
            		@csrf
                    @method('DELETE')
                    Apakah anda yakin ingin menghapus data ini?
            	</div>
            	<div class="modal-footer">
            		<button type="submit" class="btn btn-primary">Ya</button>
            		<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            	</div>
            </form>
        </div>
    </div> 
</div>

<script src="{{ asset('assets/js/dataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
<script>
	$(function (){
		
		var table = $('#data-kota').DataTable({
        	processing: true,
            serverSide: true,
            ajax: {
                url: "/datakota",
                data: function (d) {
                    d.provinsi = $('#list_provinsi').val()
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nama_kota', name: 'nama_kota'},
                {data: 'nama_provinsi', name: 'nama_provinsi'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true
                },
            ]
        });

        $('#list_provinsi').select2();

        $('#list_provinsi').change(function(){
            table.draw();
        });

		$('#plus-button').click(function(){
			$('#myModalLabel').text('Tambah Data Kota');
            $('#form-input')[0].reset();
            $('#id').val('');
            $('#alert-modal p').text('Alert');
            $('#alert-modal').addClass('hidden');
			$('#method').val('insert');
			$('#myModal').modal('show');
		});

		$(document).on('click', 'a#edit', function(e){
			e.preventDefault();
			
			$.ajax({
				url: "/datakota/"+$(this).attr('href'),
				type: 'GET',
                dataType: 'json',
                success: function(response){

                    if(response.success == true){
                        $('#myModalLabel').text('Edit Data Kota');
                        $('#method').val('update');
                        $('#id').val(response.data.id);
                        $('#nama_kota').val(response.data.nama_kota);
                        $('#provinsi').val(response.data.id_provinsi);
                        $('#myModal').modal('show');
                    }else{
                        $('#alert-table').addClass('alert-danger');
                        $('#alert-table').removeClass('alert-success');
                        $('#alert-table').show();
                        $('#alert-table p').text(response.message);
                        $('#alert-table').fadeOut(10000);
                    }
                }
			});
		});

		$('#form-input').submit(function(e){
			e.preventDefault();
			var data = $(this).serializeArray();

			if($('#method').val() == 'insert')
				var url_link = "/datakota";
			else{
				data.push({name:"_method", value:"PUT"});
				var url_link = "/datakota/"+$('#id').val();
			}
			
			$.ajax({ 
				url: url_link,
				type: "POST",
				data: data,
				dataType: 'json',
				success: function(response){ 
                    if(response.success == true){
                        $('#alert-modal p').text('Alert');
                        $('#alert-modal').addClass('hidden');
                        $('#form-input')[0].reset();
                        $('#id').val('');
                        $('#myModal').modal('hide');
                        $('#alert-table').addClass('alert-success');
                        $('#alert-table').removeClass('alert-danger');
                        $('#alert-table').show();
                        $('#alert-table p').text(response.message);
                        table.ajax.reload(null, false);
                        $('#alert-table').fadeOut(10000);
                    }else{
                        $('#alert-modal p').text(response.message);
                        $('#alert-modal').removeClass('hidden');
                    }
				}
			});
		});

		$(document).on('click', 'a#hapus', function(e){ 
			e.preventDefault();
			$('#link').val($(this).attr('href'));
			$('#modal-confirm').modal('show');
		});

		$('#form-hapus').submit(function(e){
			e.preventDefault();
			$.ajax({
				url: "/datakota/"+$('#link').val(),
				type: "POST",
				data: $(this).serializeArray(),
				dataType: 'json',
				success: function(response){
					$('#modal-confirm').modal('hide'); 
                    if(response.success == true){
                        $('#alert-table').addClass('alert-success');
                        $('#alert-table').removeClass('alert-danger');
                    }else{
                        $('#alert-table').addClass('alert-danger');
                        $('#alert-table').removeClass('alert-success');
                    }
                    $('#link').val('');
                    $('#alert-table').show();
                    $('#alert-table p').text(response.message);
                    table.ajax.reload(null, false);
                    $('#alert-table').fadeOut(10000);
				}
			});
		});

	});
</script>

@endsection