<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bank & Rekening</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2>Daftar Bank & Rekening</h2>
            <a href="{{ route('bank.create') }}" class="btn btn-primary mb-3">Tambah Rekening Baru</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bank / E-Wallet</th>
                        <th>Nomor Rekening</th>
                        <th>Nama Pemilik</th>
                        <th>Logo</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bankAccounts as $bank)
<tr>
    <td>{{ $bank->id }}</td>
    <td>{{ $bank->bank_name }}</td>
    <td>{{ $bank->type }}</td>
    <td>{{ $bank->account_number }}</td>
    <td>{{ $bank->owner_name }}</td>
    <td>{{ $bank->status }}</td>
    <td>
        <a href="{{ route('bank.edit', $bank->id) }}">Edit</a>
        <form action="{{ route('bank.destroy', $bank->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="7">Belum ada data rekening.</td>
</tr>
@endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>