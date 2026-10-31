<?php 

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\MenuItemController; 
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\AdminUserController; 
use App\Models\Product; 

// Գլխավոր էջ՝ հասանելի բոլորին // 
Route::get('/', [HomeController::class, 'index']) ->name('home'); 

// Ապրանքների դիտում՝ հասանելի բոլորին // 
Route::get('/products', [ProductController::class, 'index']) 
    ->name('products.index'); 
 

// Հանրային մենյուի բաժին // 
Route::get('/menu/{menuItem}', [MenuItemController::class, 'publicPage']) 
    ->name('menu.show'); 

// Ապրանքների և մենյուի կառավարում՝ միայն ադմինի համար // 
Route::middleware(['auth', 'admin'])->group(function () { 
    
// Ապրանքների ավելացում, խմբագրում, ջնջում // 
Route::resource('products', ProductController::class) ->except(['index', 'show']); 

// Մենյուի կառավարում 
// 
Route::resource('menu-items', MenuItemController::class); 

// Drag-and-drop դասավորության պահպանում 
// 
Route::post('/menu-items/reorder', [MenuItemController::class, 'reorder']) 
   ->name('menu-items.reorder'); 

// Ադմինի էջ 
// 
Route::get('/admin', [AdminController::class, 'index']) ->name('admin.index'); 

// Օգտատերերի կառավարում 
// 
Route::get('/admin/users', [AdminUserController::class, 'index']) 
    ->name('admin.users.index'); }); 

    // Ապրանքի դիտման էջ՝ հասանելի բոլորին
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

// Ապրանքների տվյալները՝ միայն դիտման համար 
// 
Route::get('/products-data', function () { 
    return response()
    ->json(Product::latest()->get()); })
    ->name('products.data'); 

// Գրանցում 
// 
Route::get('/register', [AuthController::class, 'showRegister']) 
    ->name('register'); 
Route::post('/register', [AuthController::class, 'register']); 

// Մուտք
//  
Route::get('/login', [AuthController::class, 'showLogin']) ->name('login'); 
Route::post('/login', [AuthController::class, 'login']); 

// Ելք 
// 
Route::post('/logout', [AuthController::class, 'logout']) 
    ->name('logout') 
    ->middleware('auth'); 

// Լեզվի փոփոխություն 
// 
Route::get('/language/{locale}', function ($locale) { 
    if (! in_array($locale, ['hy', 'ru', 'en'])) { 
        abort(404); 
        } 
        session()->put('locale', $locale); 
        return redirect()->back(); 
        })->name('language.switch');

