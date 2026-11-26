<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function index()
    {
        $bankAccounts = BankAccount::all();
        return view('bank.index', compact('bankAccounts'));
    }

    public function create()
    {
        return view('bank.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_bank' => 'required|string|max:100',
            'type' => 'required|in:bank,ewallet',
            'nomor_rekening' => 'required|string|max:50',
            'nama_pemilik' => 'required|string|max:150',
            'logo' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        BankAccount::create([
            'bank_name' => $data['nama_bank'],
            'type' => $data['type'],
            'account_number' => $data['nomor_rekening'],
            'owner_name' => $data['nama_pemilik'],
            'logo' => $data['logo'] ?? null,
            'status' => $data['status'],
        ]);

        return redirect()->route('bank.index')->with('success', 'Data rekening berhasil ditambahkan.');
    }

    public function edit(BankAccount $bank)
    {
        return view('bank.edit', compact('bank'));
    }

    public function update(Request $request, BankAccount $bank)
    {
        $data = $request->validate([
            'nama_bank' => 'required|string|max:100',
            'type' => 'required|in:bank,ewallet',
            'nomor_rekening' => 'required|string|max:50',
            'nama_pemilik' => 'required|string|max:150',
            'logo' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $bank->update([
            'bank_name' => $data['nama_bank'],
            'type' => $data['type'],
            'account_number' => $data['nomor_rekening'],
            'owner_name' => $data['nama_pemilik'],
            'logo' => $data['logo'] ?? null,
            'status' => $data['status'],
        ]);

        return redirect()->route('bank.index')->with('success', 'Data rekening berhasil diperbarui.');
    }

    public function destroy(BankAccount $bank)
    {
        $bank->delete();

        return redirect()->route('bank.index')->with('success', 'Data rekening berhasil dihapus.');
    }
}