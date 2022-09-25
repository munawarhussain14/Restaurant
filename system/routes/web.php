<?php

use Illuminate\Support\Facades\Route;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;

if (App::environment('production')) {
    URL::forceScheme('https');
}
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

Route::get('/', function(){
    return redirect("https://giveawayapp.io");
})->name('home');

Route::get('/home', function(){
    return redirect("admin");
});

Route::get('qrcode', function() {
    // Munawarhussain14\QrCode\QRcode::png('code data text',"./uploads/restaurant/images");
    // $image = Munawarhussain14\QrCode\QRcode::png('code data text',"test.png");
    //dd("Test");
});

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

Route::get('/restaurants/pdf/view/{restaurant_id}', function($restauratn_id){
    $row = Restaurant::find($restauratn_id);
    return view("admin.restaurants.viewPdf",compact("row"));
})
    ->name('download.pdf');

Route::get('/restaurants/pdf/download/{restaurant_id}', function($restauratn_id){
    $row = Restaurant::find($restauratn_id);
      return view("admin.restaurants.viewPdf",compact("row"));
    // return Storage::disk("public")->download($row->pdf_menu,Str::slug($row->name,"-")."_menu.pdf");
})
    ->name('download.pdf');

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
    
    Route::get('/restaurants/pdf/{restaurant_id}', [App\Http\Controllers\Admin\RestaurantController::class, 'pdf'])
    ->name('restaurants.pdf');
    
    Route::post('/restaurants/qrcode/{restaurant_id}', [App\Http\Controllers\Admin\RestaurantController::class, 'uploadQrcode'])
    ->name('restaurants.qrcode');
    
    
    Route::resource(
        'waiters', App\Http\Controllers\Admin\WaiterController::class
    );

    Route::get('/waiters/create/{restaurant_id}', [App\Http\Controllers\Admin\WaiterController::class, 'create'])
    ->name('restaurant.waiters.create');

    Route::get('/waiters/pdf/{waiter_id}', [App\Http\Controllers\Admin\WaiterController::class, 'pdf'])
    ->name('waiter.pdf');
    
    Route::resource(
        'setting', App\Http\Controllers\Admin\SettingController::class
    );
   
    
    Route::post('/role-permission/{role_id}', [App\Http\Controllers\Admin\RoleController::class, 'permission'])->name('role.permission');

    Route::get('/user-permission/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'permission'])->name('user.permission');

    Route::post('/user-permission/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'savePermission'])->name('save.user.permission');

    Route::post('/user-roles/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'saveRoles'])->name('save.user.roles');
});