<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AkreditasiExport implements WithMultipleSheets
{
    use Exportable;

    protected $akreditasi;

    public function __construct(int $akreditasi)
    {
        $this->akreditasi = $akreditasi;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new HasilViewSheet($this->akreditasi);
        for ($bab=1; $bab <= 5; $bab++) {
            $sheets[] = new PenilaianPerBabViewSheet($this->akreditasi, $bab);
        }
        return $sheets;
    }
}
