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
        'puskesmas_id',
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
}
