<?php

namespace App\Http\Controllers;

use App\Exports\AkreditasiExport;
use Illuminate\Http\Request;
use App\Models\Akreditasi;
use App\Models\PenilaianElemen;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AkreditasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('download');
    }

    public function index() {
        $akreditasi = Auth::user()->akreditasis()->get();
        return response()->json([
            'status' => 200,
            'data' => $akreditasi,
        ]);
    }

    public function create(Request $req){
        $data = Akreditasi::create([
            'user_id' => Auth::user()->id,
            'nama_puskesmas' => $req['nama_puskesmas'],
            'kota' => $req['kota'],
            'provinsi' => $req['provinsi'],
            'tanggal_sa' => $req['tanggal_sa']
        ]);
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    public function show($id){
        $akreditasi = Akreditasi::find($id);
        return response()->json([
            'status' => 200,
            'data' => $akreditasi
        ]);
    }

    public function updateNilaiAkhir(Request $req) {
        $akreditasi_id = $req['akreditasi_id'];
        $bab1 = PenilaianElemen::getNilaiAkhir($akreditasi_id, 1);
        $bab2 = PenilaianElemen::getNilaiAkhir($akreditasi_id, 2);
        $bab3 = PenilaianElemen::getNilaiAkhir($akreditasi_id, 3);
        $bab4 = PenilaianElemen::getNilaiAkhir($akreditasi_id, 4);
        $bab5 = PenilaianElemen::getNilaiAkhir($akreditasi_id, 5);
        $mean = ($bab1 + $bab2 + $bab3 + $bab4 + $bab5) / 5;
        // dd($bab2);
        $data = [
            'bab_1' => $bab1,
            'bab_2' => $bab2,
            'bab_3' => $bab3,
            'bab_4' => $bab4,
            'bab_5' => $bab5,
            'nilai_akhir' => $mean
        ];
        $akreditasi = Akreditasi::find($akreditasi_id);
        $akreditasi->update($data);
        return response()->json([
            'status' => 200,
            'data' => $akreditasi
        ]);
    }

    public function download($id) {
        return Excel::download(new AkreditasiExport($id), 'akreditasi.xlsx');
    }
}
