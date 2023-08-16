<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
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
Route::post('check-subscription',[\App\Http\Controllers\SubscriptionController::class,'check_subscription']);
Route::get('expired/{pid}',[\App\Http\Controllers\SubscriptionController::class,'expired'])->name('expired');
Route::get('renew/{pid}',[\App\Http\Controllers\SubscriptionController::class,'renew'])->name('renew');

// Checkout (URL) User Part
Route::get('/bkash/pay', [\App\Http\Controllers\Payment\BkashController::class, 'payment'])->name('url-pay');
Route::post('/bkash/create', [\App\Http\Controllers\Payment\BkashController::class, 'createPayment'])->name('url-create');
Route::get('/bkash/callback', [\App\Http\Controllers\Payment\BkashController::class, 'callback'])->name('url-callback');

// Checkout (URL) Admin Part
Route::get('/bkash/refund', [\App\Http\Controllers\Payment\BkashController::class, 'getRefund'])->name('url-get-refund');
Route::post('/bkash/refund', [\App\Http\Controllers\Payment\BkashController::class, 'refundPayment'])->name('url-post-refund');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('optimize',function (){
   Artisan::call('optimize');
   return Artisan::output();
});
Route::get('migrate',function (){
    Artisan::call('migrate');
    return Artisan::output();
});
Route::get('fresh-migrate',function (){
    Artisan::call('migrate:fresh --seed');
    return Artisan::output();
});

require __DIR__.'/auth.php';


