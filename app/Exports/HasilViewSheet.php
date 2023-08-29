<?php
namespace App\Exports;

use App\Models\Akreditasi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithTitle;

class HasilViewSheet implements FromView, WithTitle
{
    private $akreditasi;

    public function __construct(int $akreditasi)
    {
        $this->akreditasi = $akreditasi;
    }

    /**
     * @return Builder
     */

    public function title() : string {
        return "HASIL & PUSKESMAS";
    }

    public function view(): View {
        return view('hasilPenilaian', [
            'data' => Akreditasi::find($this->akreditasi)
        ]);
    }
}
?>
