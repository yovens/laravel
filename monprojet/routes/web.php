<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\PurchaseController;
use App\Http\Controllers\Admin\AdminProfileController;


/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/

// Auth
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;

// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\LoanController;

// Client
use App\Http\Controllers\Client\DashboardController as ClientDashboard;
use App\Http\Controllers\Client\VehicleController as ClientVehicle;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\LoanController as ClientLoan;
use App\Http\Controllers\Client\ContactController;

// Middlewares
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsClient;
use App\Http\Middleware\CheckUserStatus;



/*
|--------------------------------------------------------------------------
| 🔓 AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| 🏠 PAGE ACCUEIL PUBLIQUE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');


/*
|--------------------------------------------------------------------------
| 🔐 ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', IsAdmin::class])
    ->group(function () {
   Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    
    
    // Dashboard
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
Route::resource('loans', LoanController::class)
    ->only(['index','destroy']);

        // Users CRUD + Block/Unblock
        Route::resource('users', UserController::class);
        Route::post('/users/{user}/block', [UserController::class, 'block'])->name('users.block');

        // Vehicles CRUD
        Route::resource('vehicles', VehicleController::class);

        // Transactions + Loans (index + destroy)
        Route::resource('transactions', TransactionController::class)->only(['index', 'destroy']);
        Route::resource('loans', LoanController::class)->only(['index', 'destroy']);




        
    });



/*
|--------------------------------------------------------------------------
| 🧑‍🤝‍🧑 CLIENT ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('client')
    ->name('client.')
    ->middleware(['auth', IsClient::class])
    ->group(function () {
     
        Route::get('/dashboard', [ClientDashboard::class, 'index'])->name('dashboard');
      
        Route::get('/vehicles', [ClientVehicle::class, 'index'])->name('vehicles');
        Route::get('/vehicle/{id}', [ClientVehicle::class, 'show'])->name('vehicle.show');

        Route::get('/cart', [CartController::class,'index'])->name('cart');
        Route::post('/cart/add/{id}', [CartController::class,'add'])->name('cart.add');
        Route::delete('/cart/delete/{id}', [CartController::class,'delete'])->name('cart.delete');

        Route::post('/loan/start/{id}', [ClientLoan::class,'start'])->name('loan.start');
        Route::get('/loan', [ClientLoan::class,'index'])->name('loan');

        Route::post('/purchase/start/{id}', [PurchaseController::class,'start'])->name('purchase.start');
        Route::post('/purchase/store', [PurchaseController::class,'store'])->name('purchase.store');

        Route::get('/transactions', [ClientLoan::class,'transactions'])->name('transactions');

        Route::get('/about', [ClientDashboard::class,'about'])->name('about');
        Route::get('/contact', [ContactController::class,'index'])->name('contact');
        Route::post('/contact/send', [ContactController::class,'send'])->name('contact.send');

        Route::post('/contact-us', [ClientController::class, 'sendContactMessage'])
    ->name('client.contact.send');
    });

