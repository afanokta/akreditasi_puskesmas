<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianElemen extends Model
{
    use HasFactory;

    protected $table = 'penilaian_elemens';

    protected $fillable = [
        'elemen_id',
        'akreditasi_id',
        'nilai',
        'fakta_analisis',
        'ketersediaan',
        'foto',
    ];

    public function elemen(){
        return $this->belongsTo(Elemen::class);
    }

    public function akreditasi() {
        return $this->belongsTo(Akreditasi::class);
    }

    public static function getNilaiAkhir($akreditasi_id, $bab_id){
        $base = PenilaianElemen::join('elemens', 'penilaian_elemens.elemen_id', '=', 'elemens.id')
        ->where('akreditasi_id', $akreditasi_id)
        ->where('elemens.bab_id', $bab_id);
        if(count($base->get()) == 0){
            return 0;
        }
        $sum = (float) $base->sum('nilai');
        $count = (float) $base->whereNotNull('nilai')->count();
        return $sum / ($count * 10) * 100;
    }
}
