<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrafficController;
use App\Http\Middleware\TrackVisitor;
use App\Http\Controllers\DashboardController;

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

// Root Site web (Frontend)
Route::get('/', function () {
    return view('index');
})->name('index')->middleware(TrackVisitor::class);

Route::get('/contact', function () { // Assuming this shows a contact form view
    return view('contact');
})->name('contact.show'); // It's good practice to name routes

Route::get('/politique-de-remboursement', function () {
    return view('politique-de-remboursement');
})->name('politique-de-remboursement')->middleware(TrackVisitor::class);

Route::get('/produit', function () { // General product listing? Consider using ProductController
    return view('produit');
})->name('produit.index'); // Example name

Route::get('/categorie', function () { // General category listing? Consider using CategoryController
    return view('categorie');
})->name('categorie.index'); // Example name


// Authentication Routes (Admin Login for Dashboard)
// This is the route that should display the login form for the dashboard
Route::get('/dashboard/', [UserController::class, 'showLogin'])->name('login');
// This is the route that should handle the form submission
Route::post('/dashboard/', [UserController::class, 'login']); // Laravel will match this to UserController@login on POST
Route::post('/dashboard/logout', [UserController::class, 'logout'])->name('logout');

// Password Reset Routes for Dashboard Users
Route::get('/dashboard/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/dashboard/forgot-password', [UserController::class, 'sendResetLink'])->name('password.email');
// Note: You'll also need routes for password reset itself (e.g., showing the reset form with token, and handling the POST to reset)


// Authenticated Dashboard Routes
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Dashboard Home
    Route::get('/home', [DashboardController::class, 'index'])->name('home'); // Was named 'dashboard', changed to 'home' to avoid conflict with prefix. Access with route('dashboard.home')

    // Categories
    Route::resource('categories', CategoryController::class)->names('categories'); // Access with e.g., route('dashboard.categories.index')
    Route::get('categories/{category}/subcategories', [CategoryController::class, 'getSubcategories'])->name('categories.subcategories');

    // Products
    Route::get('ajouter-produits', [ProductController::class, 'add_product'])->name('produits.add'); // Changed from 'dashboard.ajouter-produits'
    Route::post('ajouter-produits', [ProductController::class, 'store'])->name('produits.store'); // Changed from 'dashboard.ajouter-produits'
    Route::get('produits', [ProductController::class, 'index'])->name('produits.index');
    Route::post('validate-sku', [ProductController::class, 'validateSku'])->name('produits.validate.sku');
    Route::resource('produits', ProductController::class)->except(['index', 'store', 'create'])->names(['update' => 'produits.update', ]);
    Route::resource('produits', ProductController::class)->except(['index', 'store', 'create'])->names('produits'); // Use 'produits.show', 'produits.edit', etc. 'add_product' covers 'create'.
                                                                                                        // The existing index and store routes are defined above.

    // Orders
    Route::get('commandes', [OrderController::class, 'index'])->name('commandes.groupedOrders'); // Renamed from 'groupedOrders' for consistency. Access with route('dashboard.commandes.groupedOrders')
    Route::get('detail-commande/{red_order}', [OrderController::class, 'show'])->name('commandes.show');
    Route::put('commandes/{id}/status', [OrderController::class, 'updateStatusOrder'])->name('commandes.updateStatusOrder');

    // Clients
    Route::get('clients', [OrderController::class, 'clients'])->name('clients.index'); // Renamed from 'clients' for consistency
    Route::get('clients/{email}/commandes', [OrderController::class, 'commandesClient'])->name('clients.commandes');

    // Contact/Dealer Requests
    Route::get('contact', [ContactController::class, 'index'])->name('demandes.index');
    Route::post('demandes/update', [ContactController::class, 'update'])->name('demandes.update');
    Route::delete('demandes/{id}', [ContactController::class, 'destroy'])->name('demandes.destroy');

    // Users Management
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('profile', [UserController::class, 'showProfileDetail'])->name('profile');

    // Traffic
    Route::get('traffic', [TrafficController::class, 'index'])->name('traffic');

    // Fallback for potentially removed specific anonymous routes if they were meant for dashboard
    // For example, if 'dashboard/produits' was an anonymous function before, it's now covered by ProductController.
    // Ensure all necessary views like 'dashboard/transaction', 'dashboard/commandes' are handled by controllers or are static views not needing specific routes if covered by broader controllers.
});


// Frontend Product and Category Display
Route::get('/produit/{id}', [ProductController::class, 'show'])->name('product.detail')->middleware(TrackVisitor::class);
Route::get('/categorie/{categoryId}', [ProductController::class, 'showCategoryAndSubCategoryProducts'])->name('category.show')->middleware(TrackVisitor::class);

// Cart
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');

// Checkout Process
Route::prefix('checkout')->group(function () {
    // Afficher la page de checkout
    Route::get('/', [OrderController::class, 'checkout'])
        ->name('checkout');
          // Middleware optionnel pour vérifier que le panier n'est pas vide
 
    // Traiter la commande
    Route::post('/process', [OrderController::class, 'processOrder'])
        ->name('checkout.process');
 
    // Page de confirmation
    Route::get('/confirmation/{redOrder}', [OrderController::class, 'showOrderConfirmation'])
        ->name('checkout.confirmation');
});
 

// API for stock check (example)
Route::get('/api/check-stock/{productId}', [OrderController::class, 'checkStock'])->name('api.check.stock');

// Contact form submission (Frontend - Devenir Revendeur)
Route::post('/contact', [ContactController::class, 'store'])->name('devenir-revendeur.store')->middleware(TrackVisitor::class);

Route::get('transaction', function () {
    return view('dashboard/transaction');
})->name('transaction');

// Cleanup of old/potentially conflicting standalone dashboard routes (ensure these are now handled within the 'auth' group or are intentionally public)

/*
Route::get('dashboard/home', function () { // This was conflicting, now handled by DashboardController inside auth group
    return view('dashboard/index')->name('dashboard.home');
});


/* // These seemed to be public or misplaced dashboard routes. Ensure their functionality is covered within the auth group or defined intentionally if public.
Route::get('produits', function () { // This path is '/' + 'produits'. If meant for dashboard, should be /dashboard/produits
    return view('dashboard/produits');
});

Route::middleware(['auth'])->group(function () {
    Route::get('categories', function () { // This path is '/' + 'categories'. If meant for dashboard, should be /dashboard/categories
        return view('dashboard/categories');
    });
});
Route::get('dashboard/commandes', function () { // Now handled by OrderController inside auth group
    return view('dashboard/commandes');
})->name('dashboard.commandes'); // Name would conflict if not removed

Route::get('transaction', function () { // This path is '/' + 'transaction'. If meant for dashboard, should be /dashboard/transaction
    return view('dashboard/transaction');
})->name('transaction');
*/

?>