<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/tentang', [PublicController::class, 'about'])->name('about');
Route::view('/kontak', 'public.contact')->name('contact');
Route::view('/cara-beli', 'public.how-to-buy')->name('how_to_buy');
Route::redirect('/cara-membeli', '/cara-beli');
Route::get('/katalog', [PublicController::class, 'gallery'])->name('catalog');
Route::get('/katalog/{product}', [PublicController::class, 'show'])->name('product.show');
Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/media/{path}', function (string $path) {
    abort_unless(Storage::disk('public')->exists($path), 404);

    return response()->file(Storage::disk('public')->path($path));
})->where('path', '.*')->name('media.show');

Route::redirect('/gallery', '/katalog');
Route::redirect('/galeri', '/katalog');
Route::get('/galeri/{product}', function ($product) {
    return redirect()->route('product.show', ['product' => $product]);
});
Route::redirect('/seniman', '/katalog');
Route::redirect('/seniman/{artist}', '/katalog');
/*
|--------------------------------------------------------------------------
| Admin Routes (auth required)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('artists', ArtistController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';
