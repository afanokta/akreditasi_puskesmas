<?php
namespace App\Exports;

use App\Models\PenilaianElemen;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenilaianPerBabSheet implements FromQuery, WithTitle, WithHeadings
{
    private $bab;
    private $akreditasi;

    public function __construct(int $akreditasi, int $bab)
    {
        $this->bab = $bab;
        $this->akreditasi = $akreditasi;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return PenilaianElemen
            ::query()
            ->select([
                'bab_id',
                'standar',
                'kriteria',
                'no_urut',
                'elemen',
                'regulasi',
                'dokumen_bukti',
                'observasi',
                'wawancara',
                'simulasi',
                'fakta_analisis',
                'nilai',
            ])
            ->join('elemens', 'penilaian_elemens.elemen_id', '=', 'elemens.id')
            ->where('akreditasi_id', $this->akreditasi)
            ->where('bab_id', $this->bab);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'BAB ' . $this->bab;
    }

    public function headings(): array {
        return [
            'BAB',
            'Standar',
            'Kriteria',
            'No. Urut',
            'Elemen',
            'Regulasi',
            'Dokumen Bukti',
            'Observasi',
            'Wawancara',
            'Simulasi',
            'Fakta Analisis',
            'Nilai',
        ];
    }
}
?>
