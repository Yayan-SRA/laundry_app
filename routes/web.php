<?php

use App\Models\Store;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DurationController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SuperAdminTypesController;
use App\Http\Controllers\StoreAdminMasterController;
use App\Http\Controllers\SuperAdminMasterController;
use App\Http\Controllers\SuperAdminProductsController;
use App\Http\Controllers\SuperAdminServicesController;
use App\Http\Controllers\SuperAdminAttributesController;
use App\Http\Controllers\UserSuperAdminMasterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/dashboard/super/master/user/register', [AuthController::class, 'register'])->middleware('super');
Route::post('/dashboard/super/master/user/register', [AuthController::class, 'store'])->middleware('super');

Route::get('/', function () {
    return view('dashboard.index', [
        'title' => 'Dashboard',
        'stores' => Store::all(),
    ]);
})->middleware('admin');
Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'title' => 'Dashboard',
        'stores' => Store::all(),
    ]);
})->middleware('admin');

Route::get('/dashboard/transactions/pre', [TransactionController::class, 'choice'])->middleware('admin');
Route::resource('/dashboard/customers', CustomerController::class)->middleware('auth');
Route::resource('/dashboard/products', ProductController::class)->middleware('admin');
// Route::get('/dashboard/transactions/export', [TransactionController::class, 'export'])->name('transaction.export')->middleware('super');
Route::post('/dashboard/transactions/export', [TransactionController::class, 'export'])->name('transaction.export')->middleware('super');
Route::resource('/dashboard/transactions', TransactionController::class)->middleware('auth');
Route::resource('/dashboard/cashiers', CashierController::class)->middleware('admin');
Route::get('/price/find', [PriceController::class, 'find']);
Route::resource('/dashboard/expenditures', ExpenditureController::class)->middleware('admin');

Route::get('/dashboard/super', [SuperAdminController::class, 'index'])->name('dashboard.super')->middleware('super');
Route::get('/dashboard/super/attributes', [SuperAdminController::class, 'attr'])->middleware('super');
Route::post('/dashboard/super/attributes', [SuperAdminController::class, 'store'])->middleware('super');
Route::get('/dashboard/super/transactions', [SuperAdminController::class, 'trans'])->middleware('super');
Route::get('/compare/find', [SuperAdminController::class, 'find'])->middleware('super');
Route::get('/dashboard/super/order', [SuperAdminController::class, 'choice'])->middleware('super');
Route::get('/dashboard/super/order/create', [SuperAdminController::class, 'create'])->middleware('super');
Route::resource('/dashboard/super/customers', CustomerController::class)->middleware('super');
Route::resource('/dashboard/super/cashiers', CashierController::class)->middleware('super');
Route::resource('/dashboard/super/expenditure', ExpenditureController::class)->middleware('super');
Route::resource('/dashboard/super/finance', FinanceController::class)->middleware('super');

Route::get('/dashboard/super/master/attributes', [SuperAdminMasterController::class, 'm_attr'])->middleware('super');
Route::delete('/dashboard/super/master/attributes', [SuperAdminMasterController::class, 'delete'])->middleware('super');
Route::put('/dashboard/super/master/attributes', [SuperAdminMasterController::class, 'update'])->middleware('super');
Route::post('/dashboard/super/master/attributes', [SuperAdminMasterController::class, 'store'])->middleware('super');

Route::resource('/dashboard/super/master/store', StoreAdminMasterController::class)->middleware('super');
Route::resource('/dashboard/super/master/user', UserSuperAdminMasterController::class)->middleware('super');

// Route::resource('/dashboard/duration', DurationController::class);

// Route::get('/dashboard/super/', [SuperAdminAttributesController::class, 'index'])->middleware('super');

// tergantikan superadmincontroller
// Route::get('/compare/proid', [SuperAdminProductsController::class, 'proid'])->middleware('super');
// Route::resource('/dashboard/super/attributes/products', SuperAdminProductsController::class)->middleware('super');

// Route::get('/compare/typ', [SuperAdminTypesController::class, 'typ'])->middleware('super');
// Route::resource('/dashboard/super/attributes/types', SuperAdminTypesController::class)->middleware('super');

// Route::resource('/dashboard/super/attributes/services', SuperAdminServicesController::class)->middleware('super');
