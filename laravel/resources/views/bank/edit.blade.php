@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Rekening Pembayaran</h2>

    <form action="{{ route('bank.update', $bank->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Bank / E-Wallet</label>
            <input type="text" name="nama_bank" class="form-control"
                value="{{ old('nama_bank', $bank->bank_name) }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis</label>
            <select name="type" class="form-control" required>
                <option value="bank" {{ old('type', $bank->type) == 'bank' ? 'selected' : '' }}>Bank</option>
                <option value="ewallet" {{ old('type', $bank->type) == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Nomor Rekening</label>
            <input type="text" name="nomor_rekening" class="form-control"
                value="{{ old('nomor_rekening', $bank->account_number) }}" required>
        </div>

        <div class="mb-3">
            <label>Nama Pemilik</label>
            <input type="text" name="nama_pemilik" class="form-control"
                value="{{ old('nama_pemilik', $bank->owner_name) }}" required>
        </div>

        <div class="mb-3">
            <label>Logo</label>
            <input type="text" name="logo" class="form-control"
                value="{{ old('logo', $bank->logo) }}">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="aktif" {{ old('status', $bank->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status', $bank->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('bank.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
