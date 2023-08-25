<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomersReportsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoicesReportsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('dashboard',[DashboardController::class,'index'])->middleware(['auth','verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('/invoices', InvoicesController::class);
Route::get('/edit_invoice/{id}',[InvoicesController::class ,'edit']);
Route::get('/show_status/{id}',[InvoicesController::class,'show'])->name('show_status');
Route::post('/update_status/{id}',[InvoicesController::class,'update_status'])->name('status_update');
Route::get('/paid_invoices',[InvoicesController::class,'paid_invoices']);
Route::get('/unpaid_invoices',[InvoicesController::class,'unpaid_invoices']);
Route::get('/partial_invoices',[InvoicesController::class,'partial_invoices']);
Route::get('/print/{id}',[InvoicesController::class,'print'])->name('print_invoices');

Route::resource('/archives', InvoiceArchiveController::class);



Route::resource('/sections', SectionController::class);
Route::resource('/products', ProductController::class);
Route::get('/product/{id}',[ProductController::class,'getSectionProducts']);

Route::get('/invoicesDetails/{id}',[InvoicesDetailsController::class ,'invoiceDetail']);
Route::get('view_file/{invoice_number}/{file_name}',[InvoicesDetailsController::class,'openFile']);


Route::get('users/export/', [InvoicesController::class, 'export'])->name('export_invoices');

Route::get('/invoices_reports',[InvoicesReportsController::class , 'index']);
Route::post('/find_invoices',[InvoicesReportsController::class,'find']);

Route::get('/customers_reports',[CustomersReportsController::class,'index']);
Route::post('/find_customers',[CustomersReportsController::class,'find']);

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('markAll',[InvoicesController::class,'all']);


Route::get('/{page}',[AdminController::class,'index']);

