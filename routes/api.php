<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

$appVersion = "v1";

Route::post($appVersion . '/authentication/register', [AuthController::class, 'registerUser']);

Route::middleware(['auth:sanctum'])->group(function () use ($appVersion) {
});

Route::post($appVersion . '/transactions/credit/{userId}', [TransactionController::class, 'addTransaction']);
Route::post($appVersion . '/transactions/debit/{userId}', [TransactionController::class, 'addTransaction']);
Route::get($appVersion . '/transactions/all', [TransactionController::class, 'getAllTransactions']);
Route::get($appVersion . '/transactions/{userId}', [TransactionController::class, 'getAllTransactionsByUserId']);
Route::delete($appVersion . '/transactions/delete/{transactionId}', [TransactionController::class, 'deleteTransactionsById']);

Route::get($appVersion . '/accounts/all', [AccountController::class, 'getAllAccounts']);
Route::get($appVersion . '/accounts/total', [AccountController::class, 'getAllAccountsTotal']);
Route::get($appVersion . '/accounts/{userId}', [AccountController::class, 'getAccountByUserId']);

Route::get($appVersion . '/notices/all', [NoticeController::class, 'getAllNotices']);
Route::post($appVersion . '/notices/add', [NoticeController::class, 'createNotice']);
Route::delete($appVersion . '/notices/delete/{noticeId}', [NoticeController::class, 'deleteNotice']);


Route::post($appVersion . '/authentication/login', [AuthController::class, "login"]);
