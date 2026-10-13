<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Category;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::query()
        ->with(['category', 'user'])
        ->where('stock', '>', 0)
        ->when(request('search'), function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('product_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('color', 'like', "%{$search}%");
            });
        })
        ->when(request('category'), fn ($query, $category) => $query->where('id_category', $category))
        ->latest('publication_date')
        ->paginate(12)
        ->withQueryString();

    $cartCount = auth()->check() ? (auth()->user()->shoppingCart?->cartDetails()->sum('quantity') ?? 0) : 0;

    return view('welcome', [
        'categories' => Category::query()->orderBy('category_name')->get(),
        'products' => $products,
        'cartCount' => $cartCount,
    ]);
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registro', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/mi-cuenta', [AuthController::class, 'account'])->name('account');
    Route::get('/carrito', [AuthController::class, 'cart'])->name('cart');
    Route::post('/carrito/productos/{product}', [AuthController::class, 'addToCart'])->name('cart.add');
    Route::post('/carrito/actualizar/{detail}', [AuthController::class, 'updateCartQuantity'])->name('cart.update');
    Route::delete('/carrito/detalles/{detail}', [AuthController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout/{product?}', [AuthController::class, 'showCheckout'])->name('checkout.show');
    Route::post('/checkout', [AuthController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
