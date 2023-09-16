<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware(
            'auth:api', ['except' => ['login','register', 'verificationHandler', 'resendVerification']],
            'is_verified', ['except' => ['register', 'verificationHandler', 'resendVerification']]
        );
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        // dd($token);
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'token' => $token,
            ]);

    }

    public function register(Request $request){
        try {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $token = Str::random(64);
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_token' => $token
        ]);
        Mail::to($user)->send(new SendEmail($token));

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 403,
                'message' => $th->getMessage()
            ], 403);
        }
        }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'token' => Auth::refresh()
        ]);
    }

    public function verificationHandler($token) {
        $user = User::where('verification_token', $token)->first();
        if ($user == null) {
            return response()->json([
                'status' =>404,
                'message' => 'akun anda tidak ditemukan'
            ], 404);
        }
        $user->email_verified_at = Carbon::now();
        $user->verification_token = null;
        $user->save();
        return response()->json([
            'status' => 200,
            'message' => 'email telah diverifikasi'
        ]);
    }

    public function resendVerification(Request $req) {
        $user = User::where('email', $req['email'])->first();
        $token = Str::random(64);
        $user->verification_token = $token;
        Mail::to($user)->send(new SendEmail($token));
        return response()->json([
            'status' => 200,
            'message' => 'email verifikasi telah dikirimkan'
        ]);
    }

}
