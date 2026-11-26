<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    // Menampilkan daftar data (Read)

public function index(Request $request)
{
    $draft = $request->session()->get('donation_draft');

    if (!$draft) {
        return redirect()->route('campaigns.index')
            ->with('error', 'Data donasi tidak ditemukan.');
    }

    $paymentMethods = DB::table('payment_methods')
        ->where('status', 'aktif')
        ->orderBy('type')
        ->orderBy('bank_name')
        ->get();

    return view('payment.index', compact('draft', 'paymentMethods'));
}

    // Menampilkan form tambah (Create View)
    public function create()
    {
        return view('payment.create');
    }

    // Menyimpan data ke database (Store)
    public function store(Request $request)
    {
        $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
        ]);

        Payment::create([
            'nama_donatur' => $request->nama_donatur,
            'jumlah' => $request->jumlah,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => 'Pending'
        ]);

        return redirect()->route('payments.index')->with('success', 'Data pembayaran berhasil ditambahkan.');
    }

    // Menghapus data (Delete)
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Data pembayaran berhasil dihapus.');
    }


public function confirm(Request $request)
{
    $draft = $request->session()->get('donation_draft');

    if (!$draft) {
        return redirect()->route('campaigns.index')
            ->with('error', 'Data donasi tidak ditemukan.');
    }

    $validated = $request->validate([
        'payment_method_id' => 'required|exists:payment_methods,id',
    ]);

    $method = DB::table('payment_methods')
        ->where('id', $validated['payment_method_id'])
        ->where('status', 'aktif')
        ->first();

    if (!$method) {
        return back()->with('error', 'Metode pembayaran tidak tersedia.');
    }

    DB::transaction(function () use ($draft, $method) {
        $donor = $draft['donor'];

        $existingDonor = DB::table('donors')
            ->where('email', $donor['email'])
            ->first();

        $donorData = [
            'name' => $donor['name'],
            'phone' => $donor['phone'],
            'is_anonymous' => $donor['is_anonymous'],
            'updated_at' => now(),
        ];

        if ($existingDonor) {
            DB::table('donors')
                ->where('email', $donor['email'])
                ->update($donorData);
        } else {
            $donorData['email'] = $donor['email'];
            $donorData['created_at'] = now();

            DB::table('donors')->insert($donorData);
        }

        DB::table('donations')->insert([
            'campaign_id' => $draft['campaign_id'],
            'campaign_name' => $draft['campaign_title'],
            'amount' => $draft['amount'],
            'payment_method_id' => $method->id,
            'donor_name' => $donor['is_anonymous']
                ? 'Orang Baik'
                : $donor['name'],
            'status' => 'pending',
            'created_at' => now(),
        ]);
    });

    $request->session()->forget('donation_draft');

    return redirect()->route('campaigns.index')
        ->with('success', 'Donasi berhasil diajukan. Silakan lakukan pembayaran.');
}

}
