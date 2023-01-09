@extends('backend/template/main')
@section('title','Data Kecamatan')
@section('container')

<link href="{{ asset('assets/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
<link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet">
<style type="text/css">
	table th, table td:nth-child(1), table td:nth-child(5){
		text-align: center;
	}
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Kecamatan</h1>
            </div>  
        </div>
        <div class="row">
        	<div class="col-lg-12">

        		<div class="panel panel-default">
        			<div class="panel-heading">
                        Daftar Data Kecamatan
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
                            <div class="col-md-4">

                                <form id="table-filter">
                                    <div class="form-group">
                                        <label for="filter_provinsi">
                                            Provinsi Asal
                                        </label>
                                        <select class="form-control" id="filter_provinsi">
                                            <option value="">Semua Provinsi</option>
                                        </select>
   
                                    </div>
                                    <div class="form-group">
                                        <label for="filter_kota">
                                            Kota/Kabupaten Asal
                                        </label>
                                        <select class="form-control" id="filter_kota">
                                            <option value="">Semua Kota</option>
                                        </select>
                                    </div>
  
                                    <button type="submit" class="btn btn-info">
                                        Filter
                                    </button>&nbsp;
                                    <button type="reset" class="btn btn-default">
                                        Reset
                                    </button>
                                </form>
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
                    				<table class="table table-striped table-bordered table-hover" id="data-kecamatan">
                    					<thead>
                                    		<tr>
                                        		<th>No</th>
                                        		<th>Nama Kecamatan</th>
                                                <th>Kota Asal</th>
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
    					<label for="provinsi" class="col-sm-4 col-form-label">
    						Provinsi Asal <span style="color:red;">*</span>
    					</label>
    					<div class="col-sm-6">
      						<select class="form-control" name="provinsi" id="provinsi">
                                <option value="">Silahkan Pilih</option>
                            </select>
    					</div>
  					</div>
                    <div class="form-group row">
                        <label for="kota" class="col-sm-4 col-form-label">
                            Kota Asal <span style="color:red;">*</span>
                        </label>
                        <div class="col-sm-6">
                            <select class="form-control" name="kota" id="kota">
                                <option value="">Silahkan Pilih</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kecamatan" class="col-sm-4 col-form-label">
                            Nama Kecamatan <span style="color:red;">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Nama Kecamatan">
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
		
		var table = $('#data-kecamatan').DataTable({
        	processing: true,
            serverSide: true,
            ajax: {
                url: "/datakecamatan",
                data: function (d) {
                    d.provinsi = $('#filter_provinsi').val(),
                    d.kota = $('#filter_kota').val()
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nama_kecamatan', name: 'nama_kecamatan'},
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

        $.ajax({ 
            url: '/getprovinsi',
            type: 'GET',
            dataType: 'json',
            success: function(response){
                $.each(response.data, function(i, item){
                    $('#filter_provinsi').append($('<option>', { 
                        value: item.id,
                        text : item.nama_provinsi 
                    }));
                    $('#provinsi').append($('<option>', { 
                        value: item.id,
                        text : item.nama_provinsi 
                    }));
                });
            }
        });

        $('#filter_provinsi').select2();
        $('#filter_kota').select2();

        $('#filter_provinsi').change(function(){
            var id = $(this).val();
            $('#filter_kota option').remove(); 
            $('#filter_kota').append($('<option>', { 
                value: '',
                text : 'Semua Kota' 
            }));
            if(id != ''){

                $.ajax({ 
                    url: 'getkota/'+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response){
                        if(response.data.length > 0){
                            $.each(response.data, function(i, item){
                                $('#filter_kota').append($('<option>', { 
                                    value: item.id,
                                    text : item.nama_kota 
                                }));
                            });
                        }
                    }
                });
            }
        });

        $('#table-filter').submit(function(e){
            e.preventDefault();
            table.draw();
        });

        $('button[type=reset]').click(function(){
            $("#filter_provinsi").val('').trigger('change');
            $('#filter_kota option').remove(); 
            $('#filter_kota').append($('<option>', { 
                value: '',
                text : 'Semua Kota' 
            }));
            table.draw();
        });

		$('#plus-button').click(function(){
			$('#myModalLabel').text('Tambah Data Kecamatan');
            $('#kota option').remove(); 
            $('#kota').append($('<option>', { 
                value: '',
                text : 'Silahkan Pilih' 
            }));
			$('#form-input')[0].reset();
            $('#id').val('');
            $('#alert-modal p').text('Alert');
            $('#alert-modal').addClass('hidden');
            $('#method').val('insert');
            $('#myModal').modal('show');
		});

        $('#provinsi').change(function(){
            var id = $(this).val();
            $('#kota option').remove(); 
            $('#kota').append($('<option>', { 
                value: '',
                text : 'Silahkan Pilih' 
            }));
            if(id != ''){
                $.ajax({ 
                    url: 'getkota/'+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response){
                        if(response.data.length > 0){
                            $.each(response.data, function(i, item){
                                $('#kota').append($('<option>', { 
                                    value: item.id,
                                    text : item.nama_kota 
                                }));
                            });
                        }
                    }
                });
            }
        });

		$(document).on('click', 'a#edit', function(e){
			e.preventDefault();
			
			$.ajax({
				url: "/datakecamatan/"+$(this).attr('href'),
				type: 'GET',
                dataType: 'json',
                success: function(response){
                    if(response.success == true){
                        $('#myModalLabel').text('Edit Data Kecamatan');
                        $('#method').val('update');
                        $('#id').val(response.data.id);
                        $('#provinsi').val(response.data.provinsi);

                        $('#kota option').remove(); 
                        $('#kota').append($('<option>', { 
                            value: '',
                            text : 'Silahkan Pilih' 
                        }));
                        if(response.list_kota.length > 0){
                            $.each(response.list_kota, function(i, item){
                                $('#kota').append($('<option>', { 
                                    value: item.id,
                                    text : item.nama_kota 
                                }));
                            });
                            $('#kota').val(response.data.kota);
                        }
                        $('#kecamatan').val(response.data.nama_kecamatan);
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
				var url_link = "/datakecamatan";
			else{
				data.push({name:"_method", value:"PUT"});
				var url_link = "/datakecamatan/"+$('#id').val();
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
				url: "/datakecamatan/"+$('#link').val(),
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