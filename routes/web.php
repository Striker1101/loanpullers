<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BorrowersController;
use App\Http\Controllers\Contact;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WalletController;
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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('/dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // loan
    Route::get("loan/requested", [LoanController::class, "requested"])->name("loan.requested");
    Route::get("loan/processing", [LoanController::class, "processing"])->name("loan.processing");
    Route::get("loan/approved", [LoanController::class, "approved"])->name("loan.approved");
    Route::get("loan/denied", [LoanController::class, "denied"])->name("loan.denied");
    Route::get("loan/default", [LoanController::class, "default"])->name("loan.default");
    Route::get("loan/penalty", [LoanController::class, "penalty"])->name("loan.penalty");
    Route::get("loan/agreemenet_form", [LoanController::class, "agreemenet_form"])->name("loan.agreemenet_form");
    Route::get("loan/settlement_form", [LoanController::class, "settlement_form"])->name("loan.settlement_form");



    Route::resource("user", ProfileController::class)->names('user');
    Route::get("user/kin", [ProfileController::class, "kin"])->name("user.kin");
    Route::get("user/attachment", [ProfileController::class, "attachment"])->name("user.attachment");

    Route::resource("loan", LoanController::class)->names('loan');
    Route::resource("wallet", WalletController::class)->names('wallet');
    Route::resource("transfer", TransferController::class)->names('transfer');
    Route::resource("account", AccountController::class)->names('account');
    Route::resource("profile", ProfileController::class)->names('profile');
    Route::resource("contact", ContactController::class)->names('contact');
    Route::resource('borrower', BorrowersController::class)->names('borrower');
});

