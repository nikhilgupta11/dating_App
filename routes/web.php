<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\{
    AuthController,
    SettingController,
};
/* 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index_page');

Route::controller(AuthController::class)->prefix('/admin')->group(function () {
    // login
    Route::get('/login', 'login_check')->name('login_screen');
    Route::post('/logged-in', 'login')->name('admin_login');

    // forgot password
    Route::get('forgot-pasword', function () {
        return view('auth/forgot_password');
    })->name('forgot_pass_screen');
    Route::post('/forgot-password/email', 'forgotpassword')->name('forgotpass');
    Route::get('/forgot-password/verify/{token}', 'verifypassword')->name('verifyemail');
    Route::post('/forgot-password/reset/{token}', 'changepassword')->name('resetpassword');
});

Route::middleware(['admin_access'])->prefix('admin')->group(function () {
    Route::get('index', function () {
        return view('admin/pages/dashboard');
    })->name('admin_home');

    // chnage-password
    Route::get('/change-pasword-screen', function () {
        return view('admin/pages/change_password');
    })->name('change_password_screen');
    Route::put('change-password', [AuthController::class, 'reset_password'])->name('admin_change_password');

    // profile update
    Route::get('/profile', function () {
        return view('admin/pages/profile');
    })->name('admin_profile');
    Route::put('profile-update', [AuthController::class, 'profile_update'])->name('admin_profile_update');

    // logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // setting
    Route::get('/setting', [SettingController::class, 'index'])->name('setting_controller');
    Route::get('setting/update/{id}', [SettingController::class, 'edit'])->name('setting_update');
    Route::post('/setting/create/{id?}', [SettingController::class, 'store'])->name('store_setting');

    // cms
    Route::get('/content-pages', [SettingController::class, 'cms_index_function'])->name('cms_index');
    Route::get('/content-page/create', function () {
        return view('admin/pages/create_cms');
    })->name('create_cms_screen');
    Route::post('/content-page/created', [SettingController::class, 'cms_store_function'])->name('create_cms');
    Route::get('/content-page/{id}/detail', [SettingController::class, 'show_cms_function'])->name('show_cms');
    Route::get('/content-page/{id}/delete', [SettingController::class, 'delete_cms_function'])->name('delete_cms');
    Route::get('/content-page/{id}/edit', [SettingController::class, 'edit_cms_function'])->name('edit_cms');
});
