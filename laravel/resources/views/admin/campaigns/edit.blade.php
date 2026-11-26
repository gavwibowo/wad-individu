<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Edit Campaign</title>
    <link rel="stylesheet" href="{{ asset('assests/css/style.css') }}">
</head>
<body>
    <div class="container" style="padding: 40px 0;">
        <div class="card" style="max-width: 600px; margin: 0 auto;">
            <h2>Edit Program Campaign</h2>
            <form action="{{ route('admin.campaigns.update', $campaign->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $campaign->id }}">
                <div class="form-group">
                    <label>Judul Campaign</label>
                    <input type="text" name="title" class="form-control" value="{{ $campaign->title }}" required>
                </div>
                <div class="form-group">
                    <label>Kategori Bantuan</label>
                    <select name="category" class="form-control">
                        <option value="Tanggap Bencana" {{ ($campaign->category ?? '') == 'Tanggap Bencana' ? 'selected' : '' }}>Tanggap Bencana</option>
                        <option value="Pendidikan" {{ ($campaign->category ?? '') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        <option value="Kesehatan" {{ ($campaign->category ?? '') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        <option value="lifestyle devin" {{ ($campaign->category ?? '') == 'lifestyle devin' ? 'selected' : '' }}>lifestyle devin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Target Dana (Rp)</label>
                    <input type="number" name="target_amount" class="form-control" value="{{ (int)$campaign->target_amount }}" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi & Narasi</label>
                    <textarea name="description" class="form-control" rows="4" required>{{ $campaign->description ?? '' }}</textarea>
                </div>
                <button type="submit" class="btn-primary" style="margin-top: 10px;">Update Campaign</button>
                <a href="{{ route('admin.campaigns.index') }}" class="btn btn-outline" style="margin-top: 10px; display: inline-block; text-align: center; text-decoration: none;">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>