<?php

namespace App\Http\Controllers;

use App\Models\Elemen;
use App\Models\PenilaianElemen;
use Illuminate\Http\Request;
use PhpParser\PrettyPrinter\Standard;

class ElemenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index() {
        $bab = Elemen::all();
        return response()->json([
            'status' => 200,
            'data' => $bab
        ]);
    }

    public function getStandar($akreditasi_id, $bab_id) {
        $standar = Elemen::distinct()
        ->where('bab_id', $bab_id)->get(['standar']);
        foreach ($standar as $key => $value) {
            $countAll = (float) Elemen::where('standar', $value->standar)->count();
            $currentCount = PenilaianElemen::join('elemens', 'penilaian_elemens.elemen_id', '=', 'elemens.id')
            ->where('akreditasi_id', $akreditasi_id)
            ->where('standar', $value->standar)->count();
            $standar[$key]->progress =  ($currentCount / $countAll) * 100;
        }
        return response()->json([
            'status' => 200,
            'data' => $standar
        ]);
    }

    public function getKriteria($akreditasi_id, $bab_id, $standar) {
        $kriteria = Elemen::distinct()->where('bab_id', $bab_id)
        ->where('standar', $standar)
        ->get(['kriteria']);


        foreach ($kriteria as $key => $value) { //fitur progress
            $countAll = (float) Elemen::where('kriteria', $value->kriteria)->count();
            $currentCount = PenilaianElemen::join('elemens', 'penilaian_elemens.elemen_id', '=', 'elemens.id')
            ->where('akreditasi_id', $akreditasi_id)
            ->where('kriteria', $value->kriteria)->count();
            $kriteria[$key]->progress =  ($currentCount / $countAll) * 100;
        }

        return response()->json([
            'status' => 200,
            'data' => $kriteria
        ]);
    }

    public function getNomor($akreditasi_id, $bab_id, $standar, $kriteria) {
        $nomor = Elemen::select('no_urut')->where('bab_id', $bab_id)
        ->where('standar', $standar)->where('kriteria', $kriteria)
        ->get();

        foreach ($nomor as $key => $value) { //fitur progress
            $exist = PenilaianElemen::select('penilaian_elemens.id')
            ->join('elemens', 'penilaian_elemens.elemen_id', '=', 'elemens.id')
            ->where('elemens.no_urut', $value->no_urut)
            ->where('penilaian_elemens.akreditasi_id', $akreditasi_id)
            ->where('kriteria', $kriteria)
            ->where('standar', $standar)->get();
            $nomor[$key]->selesai = (count($exist) != 0) ? true : false;
            $nomor[$key]->penilaian_id = $exist->first()->id ?? null;

        }

        return response()->json([
            'status' => 200,
            'data' => $nomor
        ]);
    }

    public function getElemen($akreditasi_id, $bab_id, $standar, $kriteria, $nomor) {
        $elemen = Elemen::select('*')->where('bab_id', $bab_id)
        ->where('standar', $standar)->where('kriteria', $kriteria)
        ->where('no_urut', $nomor)
        ->get()->first();
        return response()->json([
            'status' => 200,
            'data' => $elemen
        ]);
    }


}
