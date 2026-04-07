<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route untuk guest (belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});

// Route autentikasi sederhana (tanpa controller)
Route::post('/login', function (Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    
    if (Auth::attempt($credentials, $request->remember)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }
    
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
})->name('login.post');

Route::post('/logout', function (Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::post('/register', function (Illuminate\Http\Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);
    
    $user = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'user',
    ]);
    
    Auth::login($user);
    
    return redirect('/dashboard');
})->name('register.post');

// Route yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Items (Inventaris) - Using handle method
    Route::get('/items', [ItemController::class, 'index'])->name('items');
    Route::post('/items', [ItemController::class, 'handle'])->name('items');
    Route::put('/items/{itemId}', [ItemController::class, 'handle'])->name('items.update');
    Route::delete('/items/{itemId}', [ItemController::class, 'handle'])->name('items.delete');
    
    // Loans (Peminjaman)
    Route::get('/loans', [LoanController::class, 'loans'])->name('pinjamBarang');
    Route::post('/items/borrow', [LoanController::class, 'borrow'])->name('items.borrow');
    Route::put('/items/return/{loan}', [LoanController::class, 'return'])->name('items.return');
    Route::delete('/loans/{id}', [LoanController::class, 'destroy'])->name('loans.destroy');
    Route::get('/loans/{id}', [LoanController::class, 'getDetail'])->name('loans.detail');
    
    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::post('/transactions/{id}/pay', [TransactionController::class, 'pay'])->name('transactions.pay');
    Route::get('/transactions/{id}/receipt', [TransactionController::class, 'receipt'])->name('transactions.receipt');
    
    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users', [UserController::class, 'handle'])->name('users');
    Route::put('/users/{userId}', [UserController::class, 'handle'])->name('users.update');
    Route::delete('/users/{userId}', [UserController::class, 'handle'])->name('users.delete');
    
    // Logs
    Route::get('/logs', [LogController::class, 'index'])->name('logs');
    Route::delete('/logs/{logId}', [LogController::class, 'handle'])->name('logs.delete');
});