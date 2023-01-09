@extends('backend/template/main')
@section('title','Daftar Customer')
@section('container')

<link href="{{ asset('assets/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
<link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet">
<style type="text/css">
	table th, table td:nth-child(1), table td:nth-child(6){
		text-align: center;
	}
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Daftar Customer</h1>
            </div>  
        </div>
        <div class="row">
        	<div class="col-lg-12">

        		<div class="panel panel-default">
        			<div class="panel-heading">
                        Daftar Data Customer
                    </div>
                    <div class="panel-body">
                    	<div class="row">
                    		<div class="col-lg-12">
                    			<a href="/datacustomer/create" class="btn btn-primary">
                    				<i class="fa fa-plus-circle"></i> Tambah Data
                    			</a>
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

                                    @can('isAdmin')
                                    <div class="form-group">
                                        <label for="filter_user">
                                            Pembuat Data
                                        </label>
                                        <select class="form-control" id="filter_user">
                                            <option value="">Semua User</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endcan
  
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
                    			<div class="alert alert-success alert-dismissible" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <p style="display:inline">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                     
                                </div>

                                @if(session()->has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif

                    			<div class="table-responsive">
                    				<table class="table table-striped table-bordered table-hover" id="data-customer">
                    					<thead>
                                    		<tr>
                                        		<th>No</th>
                                        		<th>Nama Customer</th>
                                                <th>No. Telp</th>
                                                <th>Provinsi</th>
                                                <th>Kota/Kabupaten</th>
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
		
		var table = $('#data-customer').DataTable({
        	processing: true,
            serverSide: true,
            ajax: {
                url: "/datacustomer",
                data: function (d) {
                    d.provinsi = $('#filter_provinsi').val(),
                    @can('isAdmin')
                    d.kota = $('#filter_kota').val(),
                    d.user = $('#filter_user').val()
                    @else
                    d.kota = $('#filter_kota').val()
                    @endcan
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nama', name: 'nama'},
                {data: 'nomor_telepon', name: 'nomor_telepon'},
                {data: 'nama_provinsi', name: 'nama_provinsi'},
                {data: 'nama_kota', name: 'nama_kota'},
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
                });
            }
        });

        $('#filter_provinsi').select2();
        $('#filter_kota').select2();

        @can('isAdmin')
        $('#filter_user').select2();
        @endcan

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

            @can('isAdmin')
            $("#filter_user").val('').trigger('change');
            @endcan

            table.draw();
        });

		$(document).on('click', 'a#hapus', function(e){ 
			e.preventDefault();
			$('#link').val($(this).attr('href'));
			$('#modal-confirm').modal('show');
		});

		$('#form-hapus').submit(function(e){
			e.preventDefault();
			$.ajax({
				url: "/datacustomer/"+$('#link').val(),
				type: "POST",
				data: $(this).serializeArray(),
				dataType: 'json',
				success: function(response){
					$('#modal-confirm').modal('hide'); 
					if(response.success == true){
                        $('div.alert').addClass('alert-success');
                        $('div.alert').removeClass('alert-danger');
                    }else{
                        $('div.alert').addClass('alert-danger');
                        $('div.alert').removeClass('alert-success');
                    }
					$('#link').val('');
					$('div.alert').show();
					$('div.alert p').text(response.message);
					table.ajax.reload(null, false);
					$('div.alert').fadeOut(10000);
				}
			});
		});

	});
</script>

@endsection