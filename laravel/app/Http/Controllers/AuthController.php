<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
public function showLoginForm()
{
return view('auth.login');
}
public function login(Request $request)
{
$credentials = $request->validate([
'email' => 'required|email',
'password' => 'required',
]);
//  Cek Log-in
if (Auth::attempt($credentials)) {
    $request->session()->regenerate();
    $user = Auth::user();

    // Admin & Staff -> Ke Dashboard Admin
    if ($user->role === 'admin' || $user->role === 'staff') {
        return redirect()->route('admin.campaigns.index');
    }

    // User Biasa -> Ke Halaman Campaign Publik
    return redirect()->route('campaigns.index')->with('success', 'Selamat datang kembali!');
}
return back()->withErrors([
'email' => 'Email atau password yang Anda masukkan salah.',
])->onlyInput('email');
}
public function logout(Request $request)
{
Auth::logout();
$request->session()->invalidate();
$request->session()->regenerateToken();
return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
}
}
