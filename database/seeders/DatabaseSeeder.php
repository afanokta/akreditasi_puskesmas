<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Imports\ElemenImport;
use App\Models\PenilaianElemen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// require_once 'DataBab1.php';

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert(
            [
                [
                    'nama' => 'ujang',
                    'email' => 'ujang@gmail.com',
                    'password' => bcrypt('password'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama' => 'tatang',
                    'email' => 'tatang@gmail.com',
                    'password' => bcrypt('password'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );

        // DB::table('puskesmas')->insert([
        //     [
        //         'nama' => 'Puskesmas Jetis',
        //         'alamat' => 'Jl. Pangeran Diponegoro No.91, Bumijo, Kec. Jetis, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55231',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Puskesmas Mantrijeron',
        //         'alamat' => 'Jl. DI Panjaitan No.82, Suryodiningratan, Kec. Mantrijeron, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55141',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'nama' => 'Puskesmas Gondokusuman II',
        //         'alamat' => 'Jl. DR. Sardjito No.22, Terban, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55223',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);
        DB::table('babs')->insert([
            [
                'judul' => 'Kepemimpinan dan Manajemen Puskesmas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Penyelenggaraan UKM yang berorientasi pada upaya promotf dan preventif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Penyelenggaraan UKP,  Farmasi dan Laboratorium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Program Prioritas Nasional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Peningkatan Mutu Puskesmas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        Excel::import(new ElemenImport, 'public/file_SA/bab1.xlsx');
        Excel::import(new ElemenImport, 'public/file_SA/bab2.xlsx');
        Excel::import(new ElemenImport, 'public/file_SA/bab3.xlsx');
        Excel::import(new ElemenImport, 'public/file_SA/bab4.xlsx');
        Excel::import(new ElemenImport, 'public/file_SA/bab5.xlsx');

        DB::table('akreditasis')->insert([
            'user_id' => 1,
            'nama_puskesmas' => 'Puskesmas Jetis',
            'kota' => 'Yogyakarta',
            'provinsi' => 'Daerah Istimewa Yogyakarta',
            'tanggal_sa' => '2023-08-18',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        PenilaianElemen::factory(328)->create();



    }
}
