<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\Others;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserManagementController;
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



Route::middleware(['auth:sanctum'])->group(function () use ($appVersion) {

    Route::middleware(['checkIfAdmin'])->group(function () use ($appVersion) {
        Route::post($appVersion . '/authentication/register', [AuthController::class, 'registerUser']);

        Route::post($appVersion . '/transactions/credit/{userId}', [TransactionController::class, 'addTransaction']);
        Route::post($appVersion . '/transactions/debit/{userId}', [TransactionController::class, 'addTransaction']);
        Route::get($appVersion . '/transactions/all', [TransactionController::class, 'getAllTransactions']);
        Route::get($appVersion . '/transactions/all/{accountType}', [TransactionController::class, 'getAllTransactionsByAccountType']);

        Route::delete($appVersion . '/transactions/delete/{transactionId}', [TransactionController::class, 'deleteTransactionsById']);

        Route::get($appVersion . '/accounts/all', [AccountController::class, 'getAllAccounts']);

        Route::put($appVersion . '/user-management/suspend/{userId}', [UserManagementController::class, 'suspendUser']);

        Route::post($appVersion . '/notices/add', [NoticeController::class, 'createNotice']);
        Route::delete($appVersion . '/notices/delete/{noticeId}', [NoticeController::class, 'deleteNotice']);

        Route::get($appVersion . '/members/all', [Others::class, 'getAllMembers']);
    });

    Route::get($appVersion . '/transactions/{userId}', [TransactionController::class, 'getAllTransactionsByUserId']);

    Route::get($appVersion . '/accounts/total', [AccountController::class, 'getAllAccountsTotal']);
    Route::get($appVersion . '/accounts/{userId}', [AccountController::class, 'getAccountByUserId']);

    Route::put($appVersion . '/user-management/update/{userId}', [UserManagementController::class, 'updateUser']);
    Route::put($appVersion . '/user-management/update/password/{userId}', [UserManagementController::class, 'updatePassword']);

    Route::get($appVersion . '/notices/all/', [NoticeController::class, 'getAllNotices']);
});


Route::post($appVersion . '/authentication/login', [AuthController::class, "login"]);
