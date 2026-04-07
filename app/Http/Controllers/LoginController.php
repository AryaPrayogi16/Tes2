<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

   public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Tentukan mau ke mana (redirect_to)
        $url = ($user->role === 'admin') ? route('admin.home') : route('user.home');

        return response()->json([
            'status' => 'success',
            'redirect_to' => $url
        ]);
    }

    return response()->json(['status' => 'error', 'message' => 'Login Gagal'], 401);
}
public function adminPage(Request $request) {
    // 1. Ambil input dari form, jika kosong gunakan default (misal: awal bulan s/d hari ini)
    $pernr = $request->input('pernr', '10007777');
    $begda = $request->input('begda', Carbon::now()->startOfMonth()->format('d.m.Y'));
    $endda = $request->input('endda', Carbon::now()->format('d.m.Y'));

    // 2. Siapkan parameter untuk API
    $params = [
        "pernr" => $pernr,
        "begda" => $begda,
        "endda" => $endda
    ];

    try {
        $response = Http::withHeaders([
            'X-SAP-Username' => 'basis',
            'X-SAP-Password' => '123itthebest',
            'Content-Type'   => 'application/json'
        ])->post('http://192.168.254.252:5039/api/monitoring/attendance', $params);

        $json = $response->json();

        return view('admin_dashboard', [
            'data_attendance' => $json['data'] ?? [],
            'filter' => $params
        ]);

    } catch (\Exception $e) {
        return back()->with('error', 'Gagal mengambil data dari server SAP.');
    }
}
// Fungsi untuk menampilkan halaman User
public function userPage() {
    if (Auth::user()->role !== 'user') return redirect('/login');
    return view('user_dashboard');
}
public function dashboard(Request $request) {
    // Ambil data user yang sedang login
    $user = Auth::user();
    
    // Gunakan pernr dari user login, jika admin buka filter bisa ganti pernr lain
    $pernr = $request->input('pernr', $user->pernr); 
    $begda = $request->input('begda', Carbon::now()->startOfMonth()->format('d.m.Y'));
    $endda = $request->input('endda', Carbon::now()->format('d.m.Y'));

    $params = [
        "pernr" => $pernr,
        "begda" => $begda,
        "endda" => $endda
    ];

    try {
        $response = Http::withHeaders([
            'X-SAP-Username' => 'basis',
            'X-SAP-Password' => '123itthebest',
        ])->post('http://192.168.254.252:5039/api/monitoring/attendance', $params);

        $json = $response->json();

        return view('dashboard', [
            'data_attendance' => $json['data'] ?? [],
            'filter' => $params,
            'user' => $user // Kirim data user ke view
        ]);
    } catch (\Exception $e) {
        return back()->with('error', 'Koneksi ke server SAP terputus.');
    }
}
}

