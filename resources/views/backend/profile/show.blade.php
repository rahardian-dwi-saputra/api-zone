@extends('backend/template/main')
@section('title','Akun Saya')
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
                <h1 class="page-header">Akun Saya</h1>
            </div>  
        </div>
        <div class="row">
        	<div class="col-lg-12">


        		<div class="panel panel-default">

                    <div class="panel-heading">
                        <div class="panel-title pull-left">
                            Detail Akun Saya
                        </div>
                        <div class="panel-title pull-right" style="color:#fff;">
                            <a href="/editprofil" class="btn btn-warning">
                                <i class="fa fa-edit fa-fw"></i> Edit Profil
                            </a>
                        </div>
                   
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">

                                @if(session()->has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                
                                <div class="table-responsive">

                                    <table class="table borderless">
                                        <tr>
                                            <td width="14%">
                                                <strong>Nama</strong>
                                            </td>
                                            <td width="1%">:</td>
                                            <td width="85%">
                                                {{ auth()->user()->name }}
                                            </td> 
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Username</strong>
                                            </td>
                                            <td>:</td>
                                            <td>{{ auth()->user()->username }}</td> 
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Email</strong>
                                            </td>
                                            <td>:</td>
                                            <td>{{ auth()->user()->email }}</td> 
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <a href="javascript: history.go(-1)" class="btn btn-success">
                                        <i class="fa fa-arrow-left fa-fw"></i> Kembali
                                    </a>
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