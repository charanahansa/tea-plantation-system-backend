<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\AuthController;

use App\Http\Controllers\Master\SupplierController;
use App\Http\Controllers\Master\LeafCategoryController;

use App\Http\Controllers\Transaction\LeafReceiveNoteController;
use App\Http\Controllers\Transaction\AdvancePayamentNoteController;

use App\Http\Controllers\Reports\PaymentLedgerController;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Master

Route::prefix('suppliers')->group(function () {
    Route::post('/store', [SupplierController::class, 'saveSupplier'])->name('suppliers.store')->middleware('auth:sanctum');
    Route::get('/all', [SupplierController::class, 'getAll'])->name('suppliers.all')->middleware('auth:sanctum');
    Route::get('/active-list', [SupplierController::class, 'getActiveAll'])->name('suppliers.active')->middleware('auth:sanctum');
    Route::get('/inactive-list', [SupplierController::class, 'getInactiveAll'])->name('suppliers.inactive')->middleware('auth:sanctum');
    Route::get('/find/{id}', [SupplierController::class, 'findById'])->name('suppliers.find')->middleware('auth:sanctum');
});

Route::prefix('leaf-category')->group(function () {
    Route::post('/store', [LeafCategoryController::class, 'saveLeafCategory'])->name('leaf-category.store')->middleware('auth:sanctum');
    Route::get('/all', [LeafCategoryController::class, 'getAll'])->name('leaf-category.all')->middleware('auth:sanctum');
    Route::get('/active-list', [LeafCategoryController::class, 'getActiveAll'])->name('leaf-category.active')->middleware('auth:sanctum');
    Route::get('/inactive-list', [LeafCategoryController::class, 'getInactiveAll'])->name('leaf-category.inactive')->middleware('auth:sanctum');
    Route::get('/find/{id}', [LeafCategoryController::class, 'findById'])->name('leaf-category.find')->middleware('auth:sanctum');
});

// Transaction
Route::prefix('lrn')->group(function () {
    Route::get('/load', [LeafReceiveNoteController::class, 'loadLeafReceiveNote'])->name('leaf-receive.load')->middleware('auth:sanctum');
    Route::post('/store', [LeafReceiveNoteController::class, 'saveLeafReceiveNote'])->name('leaf-receive.store')->middleware('auth:sanctum');
    Route::get('/get-transactions', [LeafReceiveNoteController::class, 'getTransactions'])->name('leaf-receive.get-transactions')->middleware('auth:sanctum');
    Route::get('/find/{id}', [LeafReceiveNoteController::class, 'findById'])->name('leaf-receive.find')->middleware('auth:sanctum');
});

Route::prefix('apn')->group(function () {
    Route::get('/load', [AdvancePayamentNoteController::class, 'loadAdvancePaymentNote'])->name('advance-payment.load')->middleware('auth:sanctum');
    Route::post('/store', [AdvancePayamentNoteController::class, 'saveAdvancePaymentNote'])->name('advance-payment.store')->middleware('auth:sanctum');
    Route::get('/get-transactions', [AdvancePayamentNoteController::class, 'getTransactions'])->name('advance-payment.get-transactions')->middleware('auth:sanctum');
    Route::get('/find/{id}', [AdvancePayamentNoteController::class, 'findById'])->name('advance-payment.find')->middleware('auth:sanctum');
});

Route::prefix('payment-ledger')->group(function () {
    Route::get('/load', [PaymentLedgerController::class, 'loadPyamentLedger'])->name('payment-ledger.load')->middleware('auth:sanctum');
    Route::post('/generate', [PaymentLedgerController::class, 'generatePyamentLedger'])->name('payment-ledger.generate')->middleware('auth:sanctum');
});

