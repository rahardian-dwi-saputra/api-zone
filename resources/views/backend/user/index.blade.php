@extends('backend/template/main')
@section('title','User API')
@section('container')

<link href="{{ asset('assets/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">

<style type="text/css">
	table th, table td:nth-child(1), table td:nth-child(6){
		text-align: center;
	}
</style>
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
                        Daftar User API
                    </div>
                    <div class="panel-body">
                    	<div class="row">
                    		<div class="col-lg-12">
                    			<a href="/user/create" class="btn btn-primary">
                    				<i class="fa fa-user-plus"></i> Tambah User
                    			</a>
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
                    				<table class="table table-striped table-bordered table-hover" id="data-user">
                    					<thead>
                                    		<tr>
                                        		<th>No</th>
                                        		<th>Nama User</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Role</th>
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

<script>
	$(function (){
		
		var table = $('#data-user').DataTable({
        	processing: true,
            serverSide: true,
            ajax: "/user",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                {data: 'role', name: 'role'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true
                },
            ]
        });

		$(document).on('click', 'a#hapus', function(e){ 
			e.preventDefault();
			$('#link').val($(this).attr('href'));
			$('#modal-confirm').modal('show');
		});

		$('#form-hapus').submit(function(e){
			e.preventDefault();
			$.ajax({
				url: "/user/"+$('#link').val(),
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