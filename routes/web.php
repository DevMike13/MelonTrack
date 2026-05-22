<?php

use App\Livewire\Auth\NotVerify;
use App\Livewire\Auth\OtpVerify;
use App\Livewire\HomePage;
use App\Livewire\Notify\NotAcceptedPage;
use App\Livewire\Pages\About;
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
Route::get('/', HomePage::class)->name('home');
Route::get('/verify-account', NotVerify::class)->name('verify.account');
Route::get('/verify-otp', OtpVerify::class)->name('otp.verify');
Route::get('/not-accepted', NotAcceptedPage::class)
    ->name('notify.not-accepted');
Route::get('/about', About::class)->name('about');
Route::get('/logagain', function () {
    return redirect( '/ibroccogreens-admin');
})->name('login');