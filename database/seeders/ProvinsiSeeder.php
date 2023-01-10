<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provinsi;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_provinsi =  [
            [
              'id' => 'P01',
              'nama_provinsi' => 'Nanggroe Aceh Darussalam (NAD)',
            ],
            [
              'id' => 'P02',
              'nama_provinsi' => 'Sumatera Utara',
            ],
            [
              'id' => 'P03',
              'nama_provinsi' => 'Sumatera Selatan',
            ],
            [
              'id' => 'P04',
              'nama_provinsi' => 'Sumatera Barat',
            ],
            [
              'id' => 'P05',
              'nama_provinsi' => 'Bengkulu',
            ],
            [
              'id' => 'P06',
              'nama_provinsi' => 'Riau',
            ],
            [
              'id' => 'P07',
              'nama_provinsi' => 'Kepulauan Riau',
            ],
            [
              'id' => 'P08',
              'nama_provinsi' => 'Jambi',
            ],
            [
              'id' => 'P09',
              'nama_provinsi' => 'Lampung',
            ],
            [
              'id' => 'P10',
              'nama_provinsi' => 'Bangka Belitung',
            ],
            [
              'id' => 'P11',
              'nama_provinsi' => 'Kalimantan Barat',
            ],
            [
              'id' => 'P12',
              'nama_provinsi' => 'Kalimantan Timur',
            ],
            [
              'id' => 'P13',
              'nama_provinsi' => 'Kalimantan Selatan',
            ],
            [
              'id' => 'P14',
              'nama_provinsi' => 'Kalimantan Tengah',
            ],
            [
              'id' => 'P15',
              'nama_provinsi' => 'Kalimantan Utara',
            ],
            [
              'id' => 'P16',
              'nama_provinsi' => 'Banten',
            ],
            [
              'id' => 'P17',
              'nama_provinsi' => 'DKI Jakarta',
            ],
            [
              'id' => 'P18',
              'nama_provinsi' => 'Jawa Barat',
            ],
            [
              'id' => 'P19',
              'nama_provinsi' => 'Jawa Tengah',
            ],
            [
              'id' => 'P20',
              'nama_provinsi' => 'DI Yogyakarta',
            ],
            [
              'id' => 'P21',
              'nama_provinsi' => 'Jawa Timur',
            ],
            [
              'id' => 'P22',
              'nama_provinsi' => 'Bali',
            ],
            [
              'id' => 'P23',
              'nama_provinsi' => 'Nusa Tenggara Timur (NTT)',
            ],
            [
              'id' => 'P24',
              'nama_provinsi' => 'Nusa Tenggara Barat (NTB)',
            ],
            [
              'id' => 'P25',
              'nama_provinsi' => 'Gorontalo',
            ],
            [
              'id' => 'P26',
              'nama_provinsi' => 'Sulawesi Barat',
            ],
            [
              'id' => 'P27',
              'nama_provinsi' => 'Sulawesi Tengah',
            ],
            [
              'id' => 'P28',
              'nama_provinsi' => 'Sulawesi Utara',
            ],
            [
              'id' => 'P29',
              'nama_provinsi' => 'Sulawesi Tenggara',
            ],
            [
              'id' => 'P30',
              'nama_provinsi' => 'Sulawesi Selatan',
            ],
            [
              'id' => 'P31',
              'nama_provinsi' => 'Maluku Utara',
            ],
            [
              'id' => 'P32',
              'nama_provinsi' => 'Maluku',
            ],
            [
              'id' => 'P33',
              'nama_provinsi' => 'Papua Barat',
            ],
            [
              'id' => 'P34',
              'nama_provinsi' => 'Papua',
            ],
        ];
        Provinsi::insert($data_provinsi);
    }
}
