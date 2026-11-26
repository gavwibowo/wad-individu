<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\View\View;

class PublicDonorController extends Controller
{
    /** Daftar donatur publik, hanya membaca kolom aman untuk publik. */
    public function index(): View
    {
        $donors = Donor::query()
            ->select(['id', 'name', 'is_anonymous'])
            ->orderByDesc('id')
            ->get();

        return view('donors.public.index', compact('donors'));
    }

    /** Detail donatur publik, tanpa email atau nomor telepon. */
    public function show(int $donor): View
    {
        $donor = Donor::query()
            ->select(['id', 'name', 'is_anonymous', 'created_at'])
            ->findOrFail($donor);

        return view('donors.public.show', compact('donor'));
    }
}
