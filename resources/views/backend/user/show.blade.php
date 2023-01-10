@extends('backend/template/main')
@section('title','User API')
@section('container')
<style type="text/css">
    table.borderless td,table.borderless th{
        border: none !important;
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
                        Detail User
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="table-responsive">

                                    <table class="table borderless">
                                        <tr>
                                            <td width="14%">
                                                <strong>Nama</strong>
                                            </td>
                                            <td width="1%">:</td>
                                            <td width="85%">
                                                {{ $data->name }}
                                            </td> 
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Email</strong>
                                            </td>
                                            <td>:</td>
                                            <td>{{ $data->email }}</td> 
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Username</strong>
                                            </td>
                                            <td>:</td>
                                            <td>{{ $data->username }}</td> 
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Role</strong>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                @if($data->is_admin)
                                                    Admin
                                                @else
                                                    User
                                                @endif
                                            </td> 
                                        </tr>
                                        
                                        
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <a href="/user" class="btn btn-primary">Kembali</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection