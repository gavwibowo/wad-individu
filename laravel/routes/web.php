
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\PublicDonorController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\PaymentController;

// ==========================================
// HOMEPAGE
// ==========================================

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// ==========================================
// CAMPAIGN - PUBLIC
// ==========================================

Route::get('/campaigns', [CampaignController::class, 'index'])
    ->name('campaigns.index');

Route::get('/campaigns/{id}', [CampaignController::class, 'show'])
    ->whereNumber('id')
    ->name('campaigns.show');

// ==========================================
// CAMPAIGN - ADMIN
// ==========================================

Route::prefix('admin/campaigns')
    ->name('admin.campaigns.')
    ->controller(CampaignController::class)
    ->group(function () {

        Route::get('/', 'adminIndex')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');

        Route::get('/{id}/edit', 'edit')
            ->whereNumber('id')
            ->name('edit');

        Route::put('/{id}', 'update')
            ->whereNumber('id')
            ->name('update');

        Route::delete('/{id}', 'destroy')
            ->whereNumber('id')
            ->name('destroy');
    });

// ==========================================
// DONORS - ADMIN
// ==========================================

Route::get('/donors', [DonorController::class, 'index'])
    ->name('donors.index');

Route::get('/donors/create', [DonorController::class, 'create'])
    ->name('donors.create');

Route::post('/donors', [DonorController::class, 'store'])
    ->name('donors.store');

Route::get('/donors/{donor}/edit', [DonorController::class, 'edit'])
    ->name('donors.edit');

Route::put('/donors/{donor}', [DonorController::class, 'update'])
    ->name('donors.update');

Route::delete('/donors/{donor}', [DonorController::class, 'destroy'])
    ->name('donors.destroy');

// ==========================================
// DONORS - PUBLIC
// ==========================================

Route::get('/donatur', [PublicDonorController::class, 'index'])
    ->name('donors.public.index');

Route::get('/donatur/{donor}', [PublicDonorController::class, 'show'])
    ->whereNumber('donor')
    ->name('donors.public.show');

// ==========================================
// DONATION
// ==========================================

Route::get('/campaigns/{id}/donate', [DonationController::class, 'create'])
    ->whereNumber('id')
    ->name('donations.create');

Route::post('/campaigns/{id}/donate', [DonationController::class, 'store'])
    ->whereNumber('id')
    ->name('donations.store');

Route::get('/donasi/pembayaran', [DonationController::class, 'paymentPending'])
    ->name('donations.payment-pending');

    Route::get('/login', function () {
	return view('auth.login');
})->name('login');



Route::post('/logout', function () {
	Auth::logout();
	return redirect()->route('home');
})->name('logout');

// 1. Halaman Form Login (GET)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// 2. Proses Submit Form Login (POST) ->
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// 3. Proses Logout (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// BANK ACCOUNT
Route::resource('bank', BankAccountController::class)->except(['show']);

// PAYMENT
Route::get('/payments', [PaymentController::class, 'index'])
    ->name('payments.index');

Route::get('/payments/create', [PaymentController::class, 'create'])
    ->name('payments.create');

Route::post('/payments', [PaymentController::class, 'store'])
    ->name('payments.store');

Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])
    ->name('payments.destroy');

Route::post('/payments/confirm', [PaymentController::class, 'confirm'])
    ->name('payments.confirm');