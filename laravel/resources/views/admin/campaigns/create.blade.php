<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Tambah Campaign</title>
    <link rel="stylesheet" href="{{ asset('assests/css/style.css') }}">
</head>
<body>
    <div class="container" style="padding: 40px 0;">
        <div class="card" style="max-width: 600px; margin: 0 auto;">
            <h2>Tambah Program Campaign Baru</h2>
            <form action="{{ route('admin.campaigns.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Judul Campaign</label>
                    <input type="text" name="title" class="form-control" placeholder="Masukan judul campaign" required>
                </div>
                <div class="form-group">
                    <label>Kategori Bantuan</label>
                    <select name="category" class="form-control">
                        <option value="Tanggap Bencana">Tanggap Bencana</option>
                        <option value="Pendidikan">Pendidikan</option>
                        <option value="Kesehatan">Kesehatan</option>
                        <option value="lifestyle devin">lifestyle devin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Target Dana (Rp)</label>
                    <input type="number" name="target_amount" class="form-control" placeholder="50000000" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi & Narasi</label>
                    <textarea name="description" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn-primary" style="margin-top: 10px;">Simpan Campaign</button>
                <a href="{{ route('admin.campaigns.index') }}" class="btn btn-outline" style="margin-top: 10px; display: inline-block; text-align: center; text-decoration: none;">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>