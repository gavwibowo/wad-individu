<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DonorController extends Controller
{
    // Tetap mempertahankan fitur Read dan Search dari tahap sebelumnya.
    public function index(Request $request)
    {
        $search = mb_substr(trim((string) $request->query('search', '')), 0, 100);

        $query = Donor::query();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $donors = $query->orderByDesc('id')->get();

        return view('admin.donors.index', compact('donors', 'search'));
    }

    // Menampilkan form Create.
    public function create()
    {
        return view('admin.donors.create');
    }

    // Validasi input dan simpan menggunakan Eloquent.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['bail', 'required', 'string', 'max:150'],
            'email' => ['bail', 'required', 'string', 'email', 'max:150', 'unique:donors,email'],
            'phone' => [
                'bail',
                'required',
                'string',
                'max:30',
                'regex:/^\+?[0-9() -]+$/',
                function ($attribute, $value, $fail) {
                    if (!is_string($value)) {
                        return;
                    }
                    $digitCount = strlen(preg_replace('/\D/', '', $value));
                    if ($digitCount < 8 || $digitCount > 15) {
                        $fail('Nomor kontak harus berisi 8–15 digit.');
                    }
                },
            ],
            'is_anonymous' => ['required', 'in:0,1'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email tersebut sudah terdaftar sebagai donatur.',
            'phone.required' => 'Nomor kontak wajib diisi.',
            'phone.regex' => 'Nomor kontak hanya boleh berisi angka, + di awal, spasi, tanda hubung, atau tanda kurung.',
            'is_anonymous.required' => 'Pilih status anonimitas.',
            'is_anonymous.in' => 'Status anonimitas harus Publik atau Anonim.',
        ]);

        // Kolom is_anonymous bertipe tinyint(1) pada database M2.
        $validated['is_anonymous'] = (int) $validated['is_anonymous'];
        Donor::create($validated);

        return redirect()->route('donors.index')
            ->with('success', 'Donatur berhasil ditambahkan.');
    }

    // Mengambil donor berdasarkan ID melalui Route Model Binding.
    public function edit(Donor $donor)
    {
        return view('admin.donors.edit', compact('donor'));
    }

    // Validasi dan simpan perubahan data donor.
    public function update(Request $request, Donor $donor)
    {
        $validated = $request->validate([
            'name' => ['bail', 'required', 'string', 'max:150'],
            // Abaikan ID donor yang sedang diedit saat mengecek email unik.
            'email' => ['bail', 'required', 'string', 'email', 'max:150', Rule::unique('donors', 'email')->ignore($donor->id)],
            'phone' => [
                'bail',
                'required',
                'string',
                'max:30',
                'regex:/^\+?[0-9() -]+$/',
                function ($attribute, $value, $fail) {
                    if (!is_string($value)) {
                        return;
                    }
                    $digitCount = strlen(preg_replace('/\D/', '', $value));
                    if ($digitCount < 8 || $digitCount > 15) {
                        $fail('Nomor kontak harus berisi 8–15 digit.');
                    }
                },
            ],
            'is_anonymous' => ['required', 'in:0,1'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email tersebut sudah dipakai donatur lain.',
            'phone.required' => 'Nomor kontak wajib diisi.',
            'phone.regex' => 'Nomor kontak hanya boleh berisi angka, + di awal, spasi, tanda hubung, atau tanda kurung.',
            'is_anonymous.required' => 'Pilih status anonimitas.',
            'is_anonymous.in' => 'Status anonimitas harus Publik atau Anonim.',
        ]);

        $validated['is_anonymous'] = (int) $validated['is_anonymous'];
        $donor->update($validated);

        return redirect()->route('donors.index')
            ->with('success', 'Data donatur berhasil diperbarui.');
    }
    // Menghapus donor tertentu melalui request DELETE (bukan GET).
    public function destroy(Donor $donor)
    {
        $donor->delete();

        return redirect()->route('donors.index')
            ->with('success', 'Data donatur berhasil dihapus.');
    }
}
