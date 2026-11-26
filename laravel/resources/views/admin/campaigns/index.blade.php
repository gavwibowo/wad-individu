<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Data Campaign</title>
	<link rel="stylesheet" href="{{ asset('assests/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assests/css/campaign_css.css') }}">
</head>
<body style="background-color: #f7f9fc;">
	<div class="container" style="padding: 40px 0;">
		<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
			<div>
				<h2 style="color: #071a40; font-weight: 900;">Kelola Data Campaign (Admin)</h2>
				<p style="color: #64748b; font-size: 0.95rem;">
					Manajemen daftar program penggalangan dana sosial.
					@if(Auth::check())
						<br><strong>Login sebagai:</strong> {{ Auth::user()->name }}
						(<span style="text-transform: uppercase; color: #2563eb; font-weight: bold;">{{ Auth::user()->role }}</span>)
					@endif
				</p>
			</div>

			<div style="display: flex; gap: 10px; align-items: center;">
				<a href="{{ route('admin.campaigns.create') }}" class="btn btn-primary">+ Tambah Campaign</a>

				<form action="{{ route('logout') }}" method="POST" style="display: inline;">
					@csrf
					<button type="submit" class="btn btn-danger" style="padding: 10px 16px; border: none; cursor: pointer; border-radius: 6px;">Logout</button>
				</form>
			</div>
		</div>

		@if(session('success'))
			<div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
				{{ session('success') }}
			</div>
		@endif

		@if(session('error'))
			<div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
				{{ session('error') }}
			</div>
		@endif

		<table class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul Campaign</th>
					<th>Kategori</th>
					<th>Target Dana</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@forelse($campaigns as $key => $item)
					<tr>
						<td>{{ $key + 1 }}</td>
						<td><strong>{{ $item->title }}</strong></td>
						<td>
							<span class="cmp-badge cmp-badge-devin">
								{{ $item->category }}
							</span>
						</td>
						<td>Rp {{ number_format($item->target_amount ?? 0, 0, ',', '.') }}</td>
						<td>
							<a href="{{ route('admin.campaigns.edit', $item->id) }}" class="btn btn-outline" style="padding: 4px 12px; font-size: 0.85rem;">Edit</a>

							@if(Auth::check() && Auth::user()->role == 'admin')
								<form action="{{ route('admin.campaigns.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus campaign ini?')">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger" style="padding: 4px 12px; font-size: 0.85rem; border: none; cursor: pointer;">Hapus</button>
								</form>
							@endif
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="5" style="text-align: center; color: #64748b;">Belum ada data campaign.</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
</body>
</html>