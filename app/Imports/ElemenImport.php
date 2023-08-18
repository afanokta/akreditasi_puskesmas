<?php

namespace App\Imports;

use App\Models\Elemen;
use Maatwebsite\Excel\Concerns\ToModel;

class ElemenImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Elemen([
            'bab_id' => $row[0],
            'standar' => $row[1],
            'kriteria' => $row[2],
            'no_urut' => $row[3],
            'elemen' => $row[4],
            'regulasi' => $row[5] ?? '',
            'dokumen_bukti' => $row[6] ?? '',
            'observasi' => $row[7] ?? '',
            'wawancara' => $row[8] ?? '',
            'simulasi' => $row[9] ?? '',
        ]);
    }
}
