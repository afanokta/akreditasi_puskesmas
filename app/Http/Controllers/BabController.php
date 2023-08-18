<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bab;

class BabController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index() {
        $bab = Bab::all();
        return response()->json([
            'status' => 200,
            'data' => $bab
        ]);
    }

    
}
