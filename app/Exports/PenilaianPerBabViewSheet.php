<?php
namespace App\Exports;

use App\Models\PenilaianElemen;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\WithTitle;

class PenilaianPerBabViewSheet implements FromView, WithTitle
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

     public function title() : string {
        return "BAB " . $this->bab;
     }
     
    public function view() : View {

        $data = PenilaianElemen::
        join('elemens', 'penilaian_elemens.elemen_id', '=', 'elemens.id')
        ->where('akreditasi_id', $this->akreditasi)
        ->where('bab_id', $this->bab)->get();
        // $storage = Storage::disk('public');
        $storage = env('APP_URL').'/storage';
        return view('penilaianPerBab', [
            'data' => $data,
            'storage' => $storage
        ]);
    }
}
?>
