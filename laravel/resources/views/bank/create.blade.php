<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rekening Bank</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Tambah Data Bank & Rekening</h2>
    <form action="{{ route('bank.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_bank" class="form-label">Nama Bank / E-Wallet</label>
            <input type="text" class="form-control" id="nama_bank" name="nama_bank" required>
        </div>
        <div class="mb-3">
            <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
            <input type="text" class="form-control" id="nomor_rekening" name="nomor_rekening" required>
        </div>
        <div class="mb-3">
            <label for="nama_pemilik" class="form-label">Nama Pemilik Rekening</label>
            <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" required>
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Logo (Opsional)</label>
            <input type="text" class="form-control" id="logo" name="logo">
        </div>
        <div>
    <label>Status</label>
    <select name="status" required>
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
    </select>
</div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('bank.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>