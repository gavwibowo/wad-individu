<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('category');
        $keyword = $request->query('q');
        
        $query = DB::table('campaigns');

        if (!empty($kategori) && $kategori !== 'Semua') {
            $query->where('category', $kategori);
        }

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        $campaigns = $query->orderBy('id', 'desc')->get();

        $categories = DB::table('campaigns')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category');

        return view('campaigns.index', compact('campaigns', 'categories', 'keyword', 'kategori'));
    }

    public function show($id)
    {
        $campaign = DB::table('campaigns')->where('id', $id)->first();
        
        if (!$campaign) {
            abort(404, 'Campaign tidak ditemukan');
        }
        
        return view('campaigns.show', compact('campaign'));
    }

    public function adminIndex()
    {
        $campaigns = DB::table('campaigns')->orderBy('id', 'desc')->get();
        
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaigns.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'target_amount' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imageName = 'hero-home.jpg'; // Gambar default jika tidak mengunggah berkas

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assests/images'), $imageName);
        }

        DB::table('campaigns')->insert([
            'title' => $request->title,
            'category' => $request->category,
            'target_amount' => $request->target_amount,
            'current_amount' => $request->current_amount ?? 0,
            'description' => $request->description,
            'image' => $imageName,
            'created_at' => now(),
            
        ]);

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $campaign = DB::table('campaigns')->where('id', $id)->first();
        
        if (!$campaign) {
            abort(404, 'Campaign tidak ditemukan');
        }
        
        return view('admin.campaigns.edit', compact('campaign'));
    }


    public function update(Request $request, $id)
    {
        $campaign = DB::table('campaigns')->where('id', $id)->first();
        
        if (!$campaign) {
            abort(404, 'Campaign tidak ditemukan');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'target_amount' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'category' => $request->category,
            'target_amount' => $request->target_amount,
            'description' => $request->description,
            
        ];

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assests/images'), $imageName);
            $data['image'] = $imageName;
        }

        DB::table('campaigns')->where('id', $id)->update($data);

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $campaign = DB::table('campaigns')->where('id', $id)->first();
        
        if (!$campaign) {
            abort(404, 'Campaign tidak ditemukan');
        }

        DB::table('campaigns')->where('id', $id)->delete();

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign berhasil dihapus!');
    }
}