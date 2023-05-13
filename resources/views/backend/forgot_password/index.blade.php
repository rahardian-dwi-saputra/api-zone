<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="icon" href="{{ asset('assets/img/icon-globe.png') }}">
        <title>Forgot Password | API Zone</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{ asset('assets/css/metisMenu.min.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset('assets/css/startmin.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="container">    
          
            <div style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Forgot Password</div>
                        <div style="float:right; font-size: 85%; position: relative; top:-10px">
                            <a href="/login">Sign In</a>
                        </div>
                    </div>  
                    <div class="panel-body" >

                        <form class="form-horizontal" role="form" method="post" action="/forgot-password">
                            
                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>

                            @if(session()->has('message'))
                            <div class="col-sm-12 alert alert-success alert-dismissible" role="alert">
                                {{ session('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            @csrf            
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">
                                    Email
                                </label>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" autofocus>
                                </div>
                            </div>           
                            <div class="form-group">                                   
                                <div class="col-md-offset-4 col-md-8">
                                    <button type="submit" class="btn btn-info">
                                        <i class="icon-hand-right"></i>Request new password
                                    </button>            
                                </div>
                            </div>       
                        </form>

                    </div>
                </div>
            </div> 
        </div>
    
        <!-- jQuery -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{ asset('assets/js/startmin.js') }}"></script>

    </body>
</html>