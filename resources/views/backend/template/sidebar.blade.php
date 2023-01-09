<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu"> 
            {!! Request::is('dashboard')? '<li class="active">':'<li>' !!} 
                <a href="/dashboard">
                    <i class="fa fa-dashboard fa-fw"></i> Dashboard
                </a>
            </li>

            @can('isAdmin')
            <li>
                <a href="#">
                    <i class="fa fa-database fa-fw"></i> Data Wilayah
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="/dataprovinsi">Data Provinsi</a>
                    </li>
                    <li>
                        <a href="/datakota">Data Kota dan Kabupaten</a>
                    </li>
                    <li>
                        <a href="/datakecamatan">Data Kecamatan</a>
                    </li>
                </ul>                 
            </li>
            @endcan

            {!! Request::is('datacustomer*')? '<li class="active">':'<li>' !!} 
                <a href="/datacustomer">
                    <i class="fa fa-user-md fa-fw"></i> Daftar Customer
                </a>
            </li>

            {!! Request::is('message*')? '<li class="active">':'<li>' !!} 
                <a href="/message">
                    <i class="fa fa-envelope fa-fw"></i> Template Pesan
                </a>
            </li>
            
            @can('isAdmin')
            
            {!! Request::is('user*')? '<li class="active">':'<li>' !!} 
                <a href="/user">
                    <i class="fa fa-users fa-fw"></i> User API
                </a>
            </li>
            @endcan
 
        </ul>
    </div>
</div>