<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ArtistController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/tentang', [PublicController::class, 'about'])->name('about');
Route::view('/kontak', 'public.contact')->name('contact');
Route::view('/cara-beli', 'public.how-to-buy')->name('how_to_buy');
Route::get('/katalog', [PublicController::class, 'gallery'])->name('catalog');
Route::get('/katalog/{product}', [PublicController::class, 'show'])->name('product.show');

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
    Route::resource('products', ProductController::class);
    Route::resource('artists', ArtistController::class);
});

require __DIR__.'/auth.php';
