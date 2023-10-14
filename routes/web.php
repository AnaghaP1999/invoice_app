<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [InvoiceController::class, 'index'])->name('dashboard');
    Route::get('/invoice-form', [InvoiceController::class, 'invoiceForm'])->name('invoice-form');
    Route::post('/generate-invoice', [InvoiceController::class, 'generateInvoice'])->name('generate-invoice');
    Route::get('/edit-invoice/{id}', [InvoiceController::class, 'editInvoiceDetails'])->name('edit-invoice');
    Route::put('invoices/{invoice}', 'InvoiceController@update')->name('invoices.update');
    Route::get('/delete-invoice/{id}', [InvoiceController::class, 'deleteInvoice'])->name('delete-invoice');
    Route::get('storage/files/{filename}', [InvoiceController::class, 'serveFile'])->where('filename', '.*')->name('files.show');

});

require __DIR__.'/auth.php';
