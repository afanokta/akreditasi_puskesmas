<?php
namespace App\Exports;

use App\Models\Akreditasi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class HasilPenilaianSheet implements FromQuery, WithTitle, WithHeadings
{
    private $akreditasi;

    public function __construct(int $akreditasi)
    {
        $this->akreditasi = $akreditasi;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return Akreditasi
            ::query()
            ->select(
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
            )
            ->where('id', $this->akreditasi);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'PUSKESMAS & HASIL';
    }

    public function headings() : array {
        return [
            'Puskesmas',
            'Kota',
            'Provinsi',
            'BAB 1',
            'BAB 2',
            'BAB 3',
            'BAB 4',
            'BAB 5',
            'Nilai Akhir',
            'Tanggal SA',
        ];
    }
}
?>
