<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama_pelanggan,
            'nomor_telepon' => $this->nomor_telepon,
            'email' => $this->email,
            'alamat' => $this->alamat,
            'provinsi' => $this->provinsi->nama_provinsi,
            'kota' => $this->kota->nama_kota,
            'kecamatan' => $this->kecamatan->nama_kecamatan,
        ];
    }
}
