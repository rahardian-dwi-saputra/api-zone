<div class="navbar-header">
    <a class="navbar-brand" href="/dashboard">APIZONE</a>
</div>
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</button>
<ul class="nav navbar-right navbar-top-links">
    @auth
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> {{ auth()->user()->name }} <b class="caret"></b>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
                <a href="/profil">
                    <i class="fa fa-user fa-fw"></i> Akun Saya 
                </a>
            </li>
            <li>
                <a href="/gantisandi">
                    <i class="fa fa-gear fa-fw"></i> Ganti Password
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <form method="post" action="/logout">
                    @csrf
                    <button type="submit" class="btn btn-link" style="color:#333;">
                        <i class="fa fa-sign-out fa-fw"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </li>
    @else
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> Belum Login
        </a>
    </li>
    @endauth
</ul>