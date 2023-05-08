<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
	
	/**
     * @OA\Info(
     *      version="1.0",
     *      title="Dokumentasi REST API Wilayah Indonesia",
     *      description="REST API untuk menarik data provinsi, kota dan kabupaten, dan kecamatan yang ada di Indonesia dan juga dilengkapi dengan fitur pembuatan daftar nama konsumen via API",
     * )
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
