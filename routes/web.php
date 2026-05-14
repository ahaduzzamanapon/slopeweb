<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\FrontendController::class, 'index'])->name('home');
Route::get('/products', [\App\Http\Controllers\FrontendController::class, 'productsIndex'])->name('products.index');
Route::get('/products/{slug}', [\App\Http\Controllers\FrontendController::class, 'product'])->name('products.show');
Route::get('/products/{slug}/quotation', [\App\Http\Controllers\FrontendController::class, 'downloadQuotation'])->name('products.quotation');

// Static Pages
Route::controller(\App\Http\Controllers\PageController::class)->group(function () {
    Route::get('/about-us', 'about')->name('about');
    Route::get('/about/team', 'team')->name('about.team');
    Route::get('/about/clients', 'clients')->name('about.clients');
    Route::get('/about/message-from-md', 'mdMessage')->name('about.md_message');
    Route::get('/branches', 'branches')->name('branches');
    Route::get('/services', 'services')->name('services');
    Route::get('/contact-us', 'contact')->name('contact');
    Route::post('/contact-us', 'contactPost')->name('contact.post');
});

Route::post('/catalogue/download', [\App\Http\Controllers\CatalogueController::class, 'download'])->name('catalogue.download');

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::redirect('/admin', '/admin/login');
