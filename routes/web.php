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
 

//Root Site web

Route::get('/', function () {
    return view('index');
})->name('index')->middleware(TrackVisitor::class);

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/politique-de-remboursement', function () {
    return view('politique-de-remboursement');
})->name('politique-de-remboursement')->middleware(TrackVisitor::class);;

Route::get('/produit', function () {
    return view('produit');
})->name('produit');

Route::get('/categorie', function () {
    return view('categorie');
})->name('categorie');
 

Route::get('dashboard/', function () {
    return view('dashboard/login');
});

Route::get('dashboard/home', function () {
    return view('dashboard/index')->name('dashboard.home');
});


Route::get('produits', function () {
    return view('dashboard/produits');
});

Route::middleware(['auth'])->group(function () { 
Route::get('categories', function () {
    return view('dashboard/categories');
});
});
Route::get('dashboard/commandes', function () {
    return view('dashboard/commandes');
})->name('dashboard.commandes');

Route::get('transaction', function () {
    return view('dashboard/transaction');
})->name('transaction');



 

// Category Routes
Route::middleware(['auth'])->group(function () { 
Route::resource('dashboard/categories', CategoryController::class)->names('dashboard.categories');});
   
    Route::prefix('dashboard/categories')->name('dashboard.categories.')->group(function () {
    Route::get('dashboard/categories', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    
    // AJAX route for subcategories
    Route::get('/{category}/subcategories', [CategoryController::class, 'getSubcategories'])
         ->name('subcategories');
 
});
Route::middleware(['auth'])->group(function () { 
Route::get('/dashboard/categories', [CategoryController::class, 'categories']);});

//Root Dashbaord

//Produits
Route::middleware(['auth'])->group(function () { 
Route::post('/dashboard/ajouter-produits', [ProductController::class, 'store'])->name('dashboard.ajouter-produits');
Route::get('/dashboard/ajouter-produits', [ProductController::class, 'add_product'])->name('dashboard.ajouter-produits');
Route::get('/dashboard/produits', [ProductController::class, 'index'])->name('dashboard.produits');

Route::post('/dashboard/validate-sku', [ProductController::class, 'validateSku'])->name('dashboard.validate.sku');
Route::resource('dashboard/produits', ProductController::class)->names('dashboard.produits');
// Afficher le formulaire de modification du produit
Route::get('/dashboard/produits/{id}/edit', [ProductController::class, 'edit'])
    ->name('produits.edit');

// Mettre à jour le produit
Route::put('/dashboard/produits/{id}', [ProductController::class, 'update'])
    ->name('produits.update');

 });
 
 Route::delete('/dashboard/produits/{id}', [ProductController::class, 'destroy'])->name('produits.destroy');

//afficher produit

Route::get('/produit/{id}', [ProductController::class, 'show'])->name('product.detail')->middleware(TrackVisitor::class);;

//affichier produit-categorie

// Route pour afficher les produits d'une catégorie et de ses sous-catégories
Route::get('/categorie/{categoryId}', [ProductController::class, 'showCategoryAndSubCategoryProducts'])->name('category.show')->middleware(TrackVisitor::class);;

//Ajouter au panie rcart lettral 

Route::post('/add-to-cart', [CartController::class, 'addToCart']);


//checkout
 
 //Order 
 
// Routes pour le processus de commande
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

// Route pour vérifier le stock (optionnel - AJAX)
Route::get('/api/check-stock/{productId}', [OrderController::class, 'checkStock'])
    ->name('api.check.stock');

    Route::get('/confirmation/{redOrder}', [OrderController::class, 'showOrderConfirmation'])->name('confirmation');

    //Logo

    //afficher commande sur dashbaord  

   /* Route::get('dashboard/detail-commande', function () {
        return view('dashboard.detail-commande');
    });*/
    Route::middleware(['auth'])->group(function () { Route::get('dashboard/commandes', function () {
        return view('dashboard.commandes');
    });
    });
    Route::get('dashboard/clients', function () {
        return view('dashboard.clients');
    });
 
    Route::middleware(['auth'])->group(function () { 
        
        
        Route::get('dashboard/commandes', [OrderController::class, 'index'])->name('groupedOrders');
    Route::get('dashboard/detail-commande/{red_order}', [OrderController::class, 'show'])->name('commandes.show');
    Route::put('dashboard/commandes/{id}/status', [OrderController::class, 'updateStatusOrder'])->name('dashboard.updateStatusOrder');
    Route::get('dashboard/clients', [OrderController::class, 'clients'])->name('clients');
Route::get('/dashboard/client/{email}', [OrderController::class, 'commandesClient'])->name('commandes.client');
Route::get('dashboard/clients/{email}/commandes', [OrderController::class, 'commandesClient'])->name('clients.commandes');
});
//contact
Route::post('/contact', [ContactController::class, 'store'])->name('devenir-revendeur.store')->middleware(TrackVisitor::class);;
Route::middleware(['auth'])->group(function () { 

Route::get('/dashboard/contact', [ContactController::class, 'index'])->name('demandes.index');
Route::post('/dashboard/demandes/update', [ContactController::class, 'update'])->name('demandes.update');
Route::delete('/dashboard/demandes/{id}', [ContactController::class, 'destroy'])->name('demandes.destroy');
});
//users

// Display users list and create form
Route::middleware(['auth'])->group(function () { 

Route::get('/dashboard/users', [UserController::class, 'index'])->name('dashboard.users');

// Store new user
Route::post('/dashboard/users', [UserController::class, 'store'])->name('dashboard.users.store');

// Update user
Route::put('/dashboard/users/{id}', [UserController::class, 'update'])->name('dashboard.users.update');

// Delete user
Route::delete('/dashboard/users/{id}', [UserController::class, 'destroy'])->name('dashboard.users.destroy');
});

//dashabord 

Route::middleware(['auth'])->group(function () { 
Route::get('/dashboard/home', [DashboardController::class, 'index'])->name('dashboard');
});
//Login admin

// Routes d'authentification
Route::get('/dashboard/', [UserController::class, 'showLogin'])->name('login');
Route::post('/dashboard/', [UserController::class, 'login']);
Route::post('/dashboard/logout', [UserController::class, 'logout'])->name('logout');

// Routes de réinitialisation de mot de passe
Route::get('/dashboard/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/dashboard/forgot-password', [UserController::class, 'sendResetLink'])->name('password.email');
Route::middleware(['auth'])->group(function () { 

Route::get('dashboard/profile', [UserController::class, 'showProfileDetail'])->name('dashboard.profile');
});
//Traffic 

Route::middleware(['auth'])->group(function () { 

    Route::get('dashboard/traffic', [TrafficController::class, 'index'])->name('dashboard.traffic');

    });



    Route::get('dashboard/produits/{product}/edit', [ProductController::class, 'edit'])->name('produits.edit');
Route::put('dashboard/produits/{product}', [ProductController::class, 'update'])->name('produits.update');
Route::delete('dashboard/produits/{product}', [ProductController::class, 'destroy'])->name('produits.destroy');