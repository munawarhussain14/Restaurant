<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('about-us', function () {
    return view('web.about-us');
});

Route::get('contact-us', function () {
    return view('web.contact-us');
});

Route::get('admin', function () {
    return redirect("admin/dashboard");
});

Auth::routes();

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function(){
    
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource(
        'users', App\Http\Controllers\Admin\UserController::class
    );

    Route::resource(
        'profile', App\Http\Controllers\Admin\ProfileController::class
    );

    Route::resource(
        'roles', App\Http\Controllers\Admin\RoleController::class
    );
    
    Route::resource(
        'permissions', App\Http\Controllers\Admin\PermissionController::class
    );

    Route::resource(
        'modules', App\Http\Controllers\Admin\ModuleController::class
    );

    Route::resource(
        'restaurants', App\Http\Controllers\Admin\RestaurantController::class
    );

    
    Route::resource(
        'setting', App\Http\Controllers\Admin\SettingController::class
    );
   
    Route::get('/read', [App\Http\Controllers\Admin\ModuleController::class, 'read'])->name('read');
    
    Route::post('/role-permission/{role_id}', [App\Http\Controllers\Admin\RoleController::class, 'permission'])->name('role.permission');

    Route::get('/user-permission/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'permission'])->name('user.permission');

    Route::post('/user-permission/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'savePermission'])->name('save.user.permission');

    Route::post('/user-roles/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'saveRoles'])->name('save.user.roles');
});