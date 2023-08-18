<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elemen extends Model
{
    use HasFactory;

    protected $table = "elemens";

    protected $fillable = [
        'bab_id',
        'kriteria',
        'no_urut',
        'elemen',
        'regulasi',
        'dokumen_bukti',
        'observasi',
        'wawancara',
        'simulasi',
    ];
}
