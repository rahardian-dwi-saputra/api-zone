<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="icon" href="{{ asset('assets/img/icon-globe.png') }}">
        <title>API Zone</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('assets/bootstrap4/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <!-- jQuery -->
        <script src="{{ asset('assets/bootstrap4/js/jquery-3.2.1.slim.min.js') }}"></script>

        <style type="text/css">
            body{
                background-image: url("{{ asset('assets/img/earth-map2.jpg') }}");
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: 100% 100%;
            }
        </style>
    </head>
    <body>
        <div class="container">

            <div class="card" style="margin-top: 10%; background-color: #000; opacity: 0.8;">
                <div class="card-body">
                    <h1 class="card-title text-white text-center mt-3 mb-5">
                        REST API WILAYAH INDONESIA
                    </h1>
                    <p class="card-text text-white text-center mt-3 mb-5">
                        REST API untuk menarik data provinsi, kota dan kabupaten, dan kecamatan yang ada di Indonesia. Dilengkapi dengan fitur pembuatan daftar nama konsumen via API
                    </p>
                    <p class="card-text text-white text-center mt-3">
                        <a href="/login" class="btn btn-lg btn-primary mr-2">
                            Login
                        </a>
                        <a href="/api/documentation" class="btn btn-lg btn-info" target="_blank">
                            Dokumentasi API
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('assets/bootstrap4/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/bootstrap4/js/bootstrap.min.js') }}"></script>
    </body>
</html>