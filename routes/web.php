<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Admin\RoleController;

use App\Models\Product;

// ========================================
// PUBLIC ROUTES
// ========================================

// Գլխավոր էջ
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Ապրանքների դիտում
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

// Ապրանքների տվյալները
Route::get('/products-data', function () {
    return response()->json(Product::latest()->get());
})->name('products.data');

// Մենյուի դիտում
Route::get('/menu/{menuItem}', [MenuItemController::class, 'publicPage'])
    ->name('menu.show');

// ========================================
// PRODUCT MANAGEMENT
// ========================================

// Ավելացում
Route::middleware(['auth', 'permission:products.create'])->group(function () {

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');
});

// Խմբագրում
Route::middleware(['auth', 'permission:products.edit'])->group(function () {

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('products.update');
});

// Ջնջում
Route::delete('/products/{product}', [ProductController::class, 'destroy'])
    ->middleware(['auth', 'permission:products.delete'])
    ->name('products.destroy');

// Ապրանքի դիտման էջ
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

// ========================================
// MENU MANAGEMENT
// ========================================

Route::middleware(['auth', 'permission:menu.manage'])->group(function () {

    Route::resource('menu-items', MenuItemController::class);

    Route::post('/menu-items/reorder', [MenuItemController::class, 'reorder'])
        ->name('menu-items.reorder');
});

// ========================================
// ADMIN DASHBOARD
// ========================================

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');

});

// ========================================
// USER MANAGEMENT
// ========================================

// Օգտատերերի դիտում
Route::get('/admin/users', [AdminUserController::class, 'index'])
    ->middleware(['auth', 'permission:users.view'])
    ->name('admin.users.index');

// Օգտատիրոջ դերի փոփոխություն
Route::put('/admin/users/{user}/role', [AdminUserController::class, 'updateRole'])
    ->middleware(['auth', 'permission:users.manage'])
    ->name('admin.users.updateRole');

// ========================================
// ROLE MANAGEMENT
// ========================================

Route::middleware('auth')->group(function () {

    // Դերերի դիտում
    Route::get('/admin/roles', [RoleController::class, 'index'])
        ->name('admin.roles.index')
        ->middleware('permission:roles.view');

    // Դերի ստեղծում
    Route::get('/admin/roles/create', [RoleController::class, 'create'])
        ->name('admin.roles.create')
        ->middleware(['permission:roles.create', 'permission:roles.manage']);

    Route::post('/admin/roles', [RoleController::class, 'store'])
        ->name('admin.roles.store')
        ->middleware(['permission:roles.create', 'permission:roles.manage']);

    // Դերի խմբագրում
    Route::get('/admin/roles/{role}/edit', [RoleController::class, 'edit'])
        ->name('admin.roles.edit')
        ->middleware(['permission:roles.edit', 'permission:roles.manage']);

    Route::put('/admin/roles/{role}', [RoleController::class, 'update'])
        ->name('admin.roles.update')
        ->middleware(['permission:roles.edit', 'permission:roles.manage']);

    // Դերի ջնջում
    Route::delete('/admin/roles/{role}', [RoleController::class, 'destroy'])
        ->name('admin.roles.destroy')
        ->middleware(['permission:roles.delete', 'permission:roles.manage']);

});

// ========================================
// AUTHENTICATION
// ========================================

// Գրանցում
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

// Մուտք
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

// Ելք
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ========================================
// LANGUAGE SWITCH
// ========================================

Route::get('/language/{locale}', function ($locale) {

    if (!in_array($locale, ['hy', 'ru', 'en'])) {
        abort(404);
    }

    session()->put('locale', $locale);

    return redirect()->back();

})->name('language.switch');

// ========================================
// EMAIL VERIFICATION
// ========================================

Route::middleware('auth')->group(function () {

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

        $request->fulfill();

        return redirect('/')->with(
            'success',
            'Ձեր էլեկտրոնային հասցեն հաջողությամբ հաստատվեց։'
        );

    })->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {

        $request->user()->sendEmailVerificationNotification();

        return back()->with(
            'success',
            'Հաստատման նամակը կրկին ուղարկվեց։'
        );

    })->middleware('throttle:6,1')
        ->name('verification.send');

});
