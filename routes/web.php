<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ImageController;
use App\Mail\WelcomeMail;
use App\Mail\NotifyUser;
use App\Models\User;
use App\Notifications\InvoicePaid;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboard Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');
});

// Dashboard Kasir
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir/dashboard', [KasirController::class, 'index'])
        ->name('kasir.dashboard');
});

// Acara 29 - Upload dan Manipulasi Gambar Produk
Route::get('/products/create', [ProductController::class, 'create'])
    ->name('products.create');

Route::post('/products', [ProductController::class, 'store'])
    ->name('products.store');

// Acara 30 - Generate Invoice PDF
Route::get('/invoice/generate', [InvoiceController::class, 'generate'])
    ->name('invoice.generate');

// Acara 31 - Manipulasi Gambar
Route::get('/images', [ImageController::class, 'index'])
    ->name('images.index');

Route::post('/images/upload', [ImageController::class, 'upload'])
    ->name('images.upload');

// Acara 32 - Tes Pengiriman Email
Route::get('/test-email', function () {
    $user = (object) [
        'name' => 'Reza',
        'email' => 'reza@example.com',
    ];

    Mail::to($user->email)->send(new WelcomeMail($user));

    return 'Email berhasil diproses! Periksa log Laravel.';
});

// Acara 32 - Tes Pengiriman Email menggunakan Queue
Route::get('/test-email-queue', function () {
    $user = (object) [
        'name' => 'Reza',
        'email' => 'reza@example.com',
    ];

    Mail::to($user->email)->queue(new WelcomeMail($user));

    return 'Email berhasil dimasukkan ke antrean Queue!';
});

// Acara 32 - Tes Email Markdown
Route::get('/test-email-markdown', function () {
    $user = (object) [
        'name' => 'Reza',
        'email' => 'reza@example.com',
    ];

    $url = url('/dashboard');

    Mail::to($user->email)->send(
        new NotifyUser($user, $url)
    );

    return 'Email Markdown berhasil diproses! Periksa log Laravel.';
});

// Acara 32 - Tes Email Notification
Route::get('/test-email-notification', function () {
    $user = (object) [
        'name' => 'Reza',
        'email' => 'reza@example.com',
    ];

    $notifiable = new \Illuminate\Notifications\AnonymousNotifiable();

    $notifiable->route('mail', $user->email)
        ->notify(new InvoicePaid());

    return 'Notifikasi email berhasil diproses! Periksa log Laravel.';
});

// Acara 32 - Tes Registrasi + Verifikasi Email (MustVerifyEmail)
Route::get('/test-register', function () {
    $user = User::create([
        'name'     => 'Reza',
        'email'    => 'reza' . time() . '@example.com',
        'password' => bcrypt('password'),
        'role'     => 'kasir', // sesuaikan dengan nilai role yang valid di project
    ]);

    // Email selamat datang
    Mail::to($user->email)->send(new WelcomeMail($user));

    // Memicu email verifikasi (karena User implements MustVerifyEmail)
    event(new Registered($user));

    // Login supaya /dashboard (middleware verified) bisa dites
    Auth::login($user);

    return 'User terdaftar & email dikirim! Periksa Mailtrap, lalu buka /dashboard.';
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';