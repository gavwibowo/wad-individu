<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - MR. BUAS</title>
	<link rel="stylesheet" href="{{ asset('assests/css/style.css') }}">
	<style>
		.login-card { max-width: 400px; margin: 80px auto; padding: 30px; background: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
		.form-group { margin-bottom: 15px; }
		.form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
		.form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
		.alert-danger { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-size: 0.9rem; }
	</style>
</head>
<body style="background-color: #f7f9fc;">
	<div class="login-card">
		<h2 style="text-align: center; margin-bottom: 20px; color: #071a40;">LOGIN</h2>

		@if($errors->any())
			<div class="alert-danger">
				{{ $errors->first() }}
			</div>
		@endif

		<form action="{{ route('login.post') }}" method="POST">
			@csrf
			<div class="form-group">
				<label>Alamat Email</label>
				<input type="email" name="email" value="{{ old('email') }}" required placeholder="admin@gmail.com">
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" required placeholder="••••••••">
			</div>

			<button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; margin-top: 10px;">Masuk</button>
		</form>
	</div>
</body>
</html>