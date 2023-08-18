<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puskesmas;

class PuskesmasController extends Controller
{
    public function index() {
        $puskesmas = Puskesmas::all();
        return response()->json([
            'status' => 200,
            'data' => $puskesmas,
        ]);
    }
}
