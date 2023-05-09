<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
  * @OA\OpenApi(
  *     @OA\Info(
  *         version="1.0",
  *         title="Dokumentasi REST API Wilayah Indonesia",
  *         description="REST API untuk menarik data provinsi, kota dan kabupaten, dan kecamatan yang ada di Indonesia dan juga dilengkapi dengan fitur pembuatan daftar nama konsumen via API",
  *     )
  * )
  */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
