<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akreditasi extends Model
{
    use HasFactory;

    protected $table = 'akreditasis';

    protected $fillable = [
        'user_id',
        'nama_puskesmas',
        'kota',
        'provinsi',
        'bab_1',
        'bab_2',
        'bab_3',
        'bab_4',
        'bab_5',
        'nilai_akhir',
        'tanggal_sa'
    ];

    public function penilaianElemens() {
        return $this->hasMany(PenilaianElemen::class);
    }

    public function puskesmas() {
        return $this->belongsTo(Puskesmas::class);
    }

    public static function updateNilai($akreditasi_id){
        $bab1 = PenilaianElemen::getNilaiAkhir($akreditasi_id, 1);
        $bab2 = PenilaianElemen::getNilaiAkhir($akreditasi_id, 2);
        $bab3 = PenilaianElemen::getNilaiAkhir($akreditasi_id, 3);
        $bab4 = PenilaianElemen::getNilaiAkhir($akreditasi_id, 4);
        $bab5 = PenilaianElemen::getNilaiAkhir($akreditasi_id, 5);
        $mean = ($bab1 + $bab2 + $bab3 + $bab4 + $bab5) / 5;
        // dd($bab2);
        $data = [
            'bab_1' => $bab1,
            'bab_2' => $bab2,
            'bab_3' => $bab3,
            'bab_4' => $bab4,
            'bab_5' => $bab5,
            'nilai_akhir' => $mean
        ];
        $akreditasi = Akreditasi::find($akreditasi_id);
        $akreditasi->update($data);
    }
}
