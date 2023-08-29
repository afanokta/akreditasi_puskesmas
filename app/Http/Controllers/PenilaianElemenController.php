<?php

namespace App\Http\Controllers;

use App\Models\Akreditasi;
use App\Models\PenilaianElemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PenilaianElemenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function create(Request $req){
        $image_path = $req->file('foto')->store('image', 'public');
        $nilai = ($req['nilai'] == 'TDD') ? null : (int) $req['nilai'];
        $data = PenilaianElemen::create([
            'elemen_id' => (int) $req['elemen_id'],
            'akreditasi_id' => (int) $req['akreditasi_id'],
            'nilai' => $nilai,
            'fakta_analisis' => $req['fakta_analisis'],
            'foto' => $image_path,
        ]);
        $data->foto = Storage::disk('public')->url($image_path);
        Akreditasi::updateNilai($req['akreditasi_id']);
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    public function update(Request $req, $id){
        $old = PenilaianElemen::find($id);
        if(Storage::disk('public')->exists($old->foto)){
            Storage::disk('public')->delete($old->foto);
        }
        $image_path = $req->file('foto')->store('image', 'public');
        $nilai = ($req['nilai'] == 'TDD') ? null : (int) $req['nilai'];
        $old->update([
            'elemen_id' => (int) $req['elemen_id'],
            'akreditasi_id' => (int) $req['akreditasi_id'],
            'nilai' => $nilai,
            'fakta_analisis' => $req['fakta_analisis'],
            'foto' => $image_path,
        ]);
        $old->foto = Storage::disk('public')->url($image_path);
        Akreditasi::updateNilai($req['akreditasi_id']);
        return response()->json([
            'status' => 200,
            'data' => $old
        ]);
    }

    public function show ($id){
        $penilaian = PenilaianElemen::find($id);
        $penilaian->foto = Storage::disk('public')->url($penilaian->foto);
        return response()->json([
            'status' => 200,
            'data' => $penilaian
        ]);
    }

    public function excel($id) {
        $data = Akreditasi::find($id);
        return view('hasilPenilaian', ['data' => $data]);
    }

    public function bab($akreditasi, $bab) {
        $data = PenilaianElemen::query()
        ->join('elemens', 'penilaian_elemens.elemen_id', '=', 'elemens.id')
        ->where('akreditasi_id', $akreditasi)
        ->where('bab_id', $bab)->get();
        // dd($data);
        return view('penilaianPerBab', ['data' => $data]);
    }
}
