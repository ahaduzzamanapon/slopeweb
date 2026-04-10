<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('login', [AuthController::class, 'loginPost'])->name('admin.login.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Settings
        Route::get('settings/general', [App\Http\Controllers\Admin\GeneralSettingController::class, 'index'])->name('admin.settings.general');
        Route::post('settings/general', [App\Http\Controllers\Admin\GeneralSettingController::class, 'update'])->name('admin.settings.general.update');

        // CMS Modules
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class)->names('admin.services');
        Route::resource('sliders', App\Http\Controllers\Admin\SliderController::class)->names('admin.sliders');
        Route::resource('contacts', App\Http\Controllers\Admin\ContactController::class)->only(['index', 'destroy'])->names('admin.contacts');
        Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class)->names('admin.projects');

        // Medical Modules
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)->names('admin.categories');
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class)->names('admin.products');
        
        // Dynamic Modules
        Route::resource('team', App\Http\Controllers\Admin\TeamMemberController::class)->names('admin.team');
        Route::resource('clients', App\Http\Controllers\Admin\ClientController::class)->names('admin.clients');
        Route::post('quotations/generate-pdf', [App\Http\Controllers\Admin\QuotationController::class, 'generate'])->name('admin.quotations.generate');
        Route::get('quotations/generate-pdf', function() {
            return redirect()->route('admin.products.index')->with('error', 'Please select products first.');
        });
        Route::resource('quotations', App\Http\Controllers\Admin\QuotationController::class)->names('admin.quotations');

        Route::post('menus/order', [\App\Http\Controllers\Admin\MenuController::class, 'updateOrder'])->name('admin.menus.order');
        Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class)->names('admin.menus');
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->names('admin.users');
        Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class)->names('admin.roles');
        Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class)->names('admin.permissions');

        Route::get('crud-builder', [\App\Http\Controllers\Admin\CrudBuilderController::class, 'index'])->name('crud-builder.index');
        Route::post('crud-builder/generate', [\App\Http\Controllers\Admin\CrudBuilderController::class, 'generate'])->name('crud-builder.generate');
        Route::get('crud-builder/models', [\App\Http\Controllers\Admin\CrudBuilderController::class, 'getModels'])->name('crud-builder.get-models');
        Route::get('crud-builder/model-columns', [\App\Http\Controllers\Admin\CrudBuilderController::class, 'getModelColumns'])->name('crud-builder.get-model-columns');

        Route::get('theme', [\App\Http\Controllers\Admin\ThemeController::class, 'index'])->name('admin.theme.index')->middleware('permission:theme.browse');
        Route::post('theme', [\App\Http\Controllers\Admin\ThemeController::class, 'update'])->name('admin.theme.update')->middleware('permission:theme.edit');

        Route::post('theme/apply', [\App\Http\Controllers\Admin\ThemeController::class, 'applyPreset'])->name('admin.theme.apply')->middleware('permission:theme.edit');
        Route::post('theme/preset', [\App\Http\Controllers\Admin\ThemeController::class, 'storePreset'])->name('admin.theme.preset.store')->middleware('permission:theme.edit');
        Route::get('theme/preset/{id}/edit', [\App\Http\Controllers\Admin\ThemeController::class, 'editPreset'])->name('admin.theme.preset.edit')->middleware('permission:theme.edit');
        Route::put('theme/preset/{id}', [\App\Http\Controllers\Admin\ThemeController::class, 'updatePreset'])->name('admin.theme.preset.update')->middleware('permission:theme.edit');
        Route::delete('theme/preset/{id}', [\App\Http\Controllers\Admin\ThemeController::class, 'destroyPreset'])->name('admin.theme.preset.destroy')->middleware('permission:theme.edit');

        Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings.index')->middleware('permission:settings.browse');
        Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update')->middleware('permission:settings.edit');

        require base_path('routes/crud.php');
    });
});
