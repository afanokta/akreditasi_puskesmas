<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\Elemen;
use App\Models\PenilaianElemen;

class BabController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index($akreditasi_id) {
        $bab = Bab::all()->makeHidden(['created_at', 'updated_at']);

        foreach ($bab as $key => $value) {
            $countAll = (float) Elemen::where('bab_id', $value->id)->count();
            $currentCount = PenilaianElemen::join('elemens', 'penilaian_elemens.elemen_id', '=', 'elemens.id')
            ->where('akreditasi_id', $akreditasi_id)
            ->where('bab_id', $value->id)->count();
            $bab[$key]->progress =  ($currentCount / $countAll) * 100;
        }

        return response()->json([
            'status' => 200,
            'data' => $bab
        ]);
    }


}
