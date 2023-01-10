@extends('backend/template/main')
@section('title','Dashboard')
@section('container')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
                       
        </div>
        <div class="row">

            @can('isAdmin')
        	<div class="col-lg-3 col-md-6">
        		<div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-bank fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $total_provinsi }}</div>
                                <div>Provinsi</div>
                            </div>
                        </div>
                    </div>
                    <a href="/dataprovinsi">
                        <div class="panel-footer">
                            <span class="pull-left">Lihat Detail</span>
                            <span class="pull-right">
                            	<i class="fa fa-arrow-circle-right"></i>
                            </span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
        	</div>

        	<div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-briefcase fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $total_kota }}</div>
                                <div>Kota dan Kabupaten</div>
                            </div>
                        </div>
                    </div>
                    <a href="/datakota">
                        <div class="panel-footer">
                            <span class="pull-left">Lihat Detail</span>
                            <span class="pull-right">
                            	<i class="fa fa-arrow-circle-right"></i>
                            </span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-map fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            	<div class="huge">{{ $total_kecamatan }}</div>
                                <div>Kecamatan</div>
                            </div>
                        </div>
                    </div>
                    <a href="/datakecamatan">
                        <div class="panel-footer">
                            <span class="pull-left">Lihat Detail</span>
                            <span class="pull-right">
                            	<i class="fa fa-arrow-circle-right"></i>
                            </span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user-md fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $total_customer }}</div>
                            	<div>Daftar Customer</div>
                            </div>
                        </div>
                    </div>
                    <a href="/datacustomer">
                        <div class="panel-footer">
                            <span class="pull-left">Lihat Detail</span>
                            <span class="pull-right">
                            	<i class="fa fa-arrow-circle-right"></i>
                            </span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            @endcan


            
        </div>      
    </div>
</div>

@endsection