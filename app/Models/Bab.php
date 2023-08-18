<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bab extends Model
{
    use HasFactory;

    protected $table = 'babs';

    protected $fillable = [
        'judul'
    ];

    public function penilaianElemens() {
        return $this->hasMany(PenilaianElemen::class);
    }
}
