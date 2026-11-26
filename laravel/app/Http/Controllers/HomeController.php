<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Statistik diambil langsung dari database, bukan angka hardcode.
        $campaignCount = DB::table('campaigns')->count();
        $fundsRaised = (int) DB::table('campaigns')->sum('current_amount');
        $donorCount = DB::table('donors')->count();

        return view('home', compact(
            'campaignCount',
            'fundsRaised',
            'donorCount'
        ));
    }
}
