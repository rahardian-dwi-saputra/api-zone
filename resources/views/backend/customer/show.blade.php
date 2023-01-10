@extends('backend/template/main')
@section('title','Daftar Customer')
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
                <h1 class="page-header">Daftar Customer</h1>
            </div>  
        </div>
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">
                        Detail Data Customer
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="table-responsive">

                                    <table class="table borderless">
                                        <tr>
                                            <td width="14%">
                                                <strong>Nama Customer</strong>
                                            </td>
                                            <td width="1%">:</td>
                                            <td width="85%">
                                                {{ $data->nama_pelanggan }}
                                            </td> 
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Nomor Telepon</strong>
                                            </td>
                                            <td>:</td>
                                            <td>{{ $data->nomor_telepon }}</td> 
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
                                                <strong>Alamat</strong>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <p style="text-align: justify;">{{ $data->alamat }}</p>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Provinsi</strong>
                                            </td>
                                            <td>:</td>
                                            <td>{{ $data->provinsi->nama_provinsi }}</td> 
                                        </tr>
                                        <tr>
                                            <td>
                                                @if(strpos($data->kota->nama_kota, 'Kota') !== false)
                                                    <strong>Kota</strong>
                                                @else
                                                    <strong>Kabupaten</strong>
                                                @endif
                                            </td>
                                            <td>:</td>
                                            <td>
                                                @if(strpos($data->kota->nama_kota, 'Kota') !== false)
                                                    {{ str_replace('Kota', '', $data->kota->nama_kota) }}
                                                @else
                                                    {{ str_replace('Kabupaten', '', $data->kota->nama_kota) }}
                                                @endif
                                            </td> 
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Kecamatan</strong>
                                            </td>
                                            <td>:</td>
                                            <td>{{ $data->kecamatan->nama_kecamatan }}</td> 
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Pembuat Data</strong>
                                            </td>
                                            <td>:</td>
                                            <td>{{ $data->user->name }}</td> 
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <a href="/datacustomer" class="btn btn-primary">Kembali</a>
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