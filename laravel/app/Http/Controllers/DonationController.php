<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function create($id)
    {
        $campaign = DB::table('campaigns')
            ->where('id', $id)
            ->first();

        if (!$campaign) {
            abort(404, 'Campaign tidak ditemukan.');
        }

        $progress = 0;

        if ($campaign->target_amount > 0) {
            $progress = (
                $campaign->current_amount /
                $campaign->target_amount
            ) * 100;
        }

        $progress = min($progress, 100);

        return view('donations.create', compact(
            'campaign',
            'progress'
        ));
    }


public function store(Request $request, $id)
{
    $campaign = DB::table('campaigns')->where('id', $id)->first();

    if (!$campaign) {
        abort(404, 'Campaign tidak ditemukan.');
    }

    $validated = $request->validate([
        'amount' => 'required|numeric|min:1',
        'name' => 'required|string|max:150',
        'email' => 'required|email|max:150',
        'phone' => 'required|string|max:30',
        'is_anonymous' => 'required|in:0,1',
    ]);

    $request->session()->put('donation_draft', [
        'campaign_id' => $campaign->id,
        'campaign_title' => $campaign->title,
        'amount' => $validated['amount'],
        'donor' => [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'is_anonymous' => (int) $validated['is_anonymous'],
        ],
    ]);

    return redirect()->route('payments.index');
}

    public function paymentPending(Request $request)
    {
        $draft = $request->session()->get('donation_draft');

        if (!$draft) {
            return redirect()->route('campaigns.index')
                ->with('error', 'Silakan pilih campaign terlebih dahulu.');
        }

        return view('donations.payment-pending', compact('draft'));
    }
}
