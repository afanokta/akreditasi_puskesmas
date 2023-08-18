<?php

namespace App\Http\Controllers;

use App\Models\PenilaianElemen;
use Illuminate\Http\Request;
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
            'ketersediaan' => (bool) $req['ketersediaan'],
            'foto' => Storage::disk('public')->url($image_path),
        ]);
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }
}
