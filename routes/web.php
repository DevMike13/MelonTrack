<?php

use App\Livewire\Auth\AccountActivationPage;
use App\Livewire\Auth\AccountVerification;
use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\NotVerify;
use App\Livewire\Auth\OtpVerify;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResendVerificationPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\HomePage;
use App\Livewire\Notify\NotAcceptedPage;
use App\Livewire\Pages\About;
use App\Livewire\Static\PrivacyPolicyPage;
use App\Livewire\Static\TermsOfServicesPage;
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
// Route::get('/logagain', function () {
//     return redirect( '/ibroccogreens-admin');
// })->name('login');

Route::middleware('guest')->group(function () {
    // AUTH
    Route::get('/register', RegisterPage::class)->name('register');
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
    Route::get('/activate-account/{token}', AccountActivationPage::class)->name('activate-account');
    Route::get('/account-verification/{user_id}', AccountVerification::class)->name('account.verify');
    Route::get('/account/resend-verification', ResendVerificationPage::class)->name('account.resend-verification');
});

// Route::get('/', LoginPage::class)->name('home');
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('filament.admin.pages.dashboard');
    }

    return redirect()->route('login');
})->name('home');
Route::get('/verify-account', NotVerify::class)->name('verify.account');
Route::get('/verify-otp', OtpVerify::class)->name('otp.verify');
Route::get('/not-accepted', NotAcceptedPage::class)
    ->name('notify.not-accepted');
Route::get('/about', About::class)->name('about');


Route::get('/terms-of-services', TermsOfServicesPage::class)->name('terms');
Route::get('/privacy-policy', PrivacyPolicyPage::class)->name('privacy');