<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kecamatan;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){
        $list_kecamatan = Kecamatan::where('id_kota','K00376')->pluck('id')->toArray();
        $n = count($list_kecamatan)-1;
        return [
            'nama_pelanggan' => $this->faker->name(),
            'nomor_telepon' => $this->faker->numerify('08##########'),
            'email' => $this->faker->freeEmail(),
            'alamat' => $this->faker->streetAddress(),  
            'provinsi_id' => 'P17', //DKI Jakarta
            'kota_id' => 'K00376', //Jakarta Pusat
            'kecamatan_id' => $list_kecamatan[mt_rand(0, $n)],
            'user_id' => mt_rand(1,2),
        ];
    }
}
