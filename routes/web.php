<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BusinessServiceController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('public.home', ['plans' => config('plans')]))->name('home');
Route::get('/how-it-works', fn () => view('public.how-it-works'))->name('public.how-it-works');
Route::get('/pricing', fn () => view('public.pricing', ['plans' => config('plans')]))->name('public.pricing');
Route::get('/setup-guide', fn () => view('public.docs'))->name('public.docs');

Route::get('/b/{business:slug}/chat', [ChatController::class, 'show'])->name('business.chat');
Route::post('/b/{business:slug}/chat/send', [ChatController::class, 'sendForBusiness'])->name('business.chat.send');
Route::get('/widget.js', WidgetController::class)->name('widget.script');

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/onboarding/business', [BusinessController::class, 'create'])->name('businesses.create');
    Route::post('/onboarding/business', [BusinessController::class, 'store'])->name('businesses.store');

    Route::get('/prospects', [ProspectController::class, 'index'])->name('prospects.index');
    Route::patch('/prospects/{prospect}/status', [ProspectController::class, 'updateStatus'])->name('prospects.status');

    Route::get('/businesses/{business}/edit', [BusinessController::class, 'edit'])->name('businesses.edit');
    Route::patch('/businesses/{business}', [BusinessController::class, 'update'])->name('businesses.update');
    Route::get('/businesses/{business}/install', [BusinessController::class, 'install'])->name('businesses.install');
    Route::get('/businesses/{business}/billing', [BusinessController::class, 'billing'])->name('businesses.billing');
    Route::patch('/businesses/{business}/billing', [BusinessController::class, 'updatePlan'])->name('businesses.billing.update');

    Route::get('/businesses/{business}/services', [BusinessServiceController::class, 'index'])->name('businesses.services.index');
    Route::post('/businesses/{business}/services', [BusinessServiceController::class, 'store'])->name('businesses.services.store');
    Route::patch('/businesses/{business}/services/{service}', [BusinessServiceController::class, 'update'])->name('businesses.services.update');
    Route::delete('/businesses/{business}/services/{service}', [BusinessServiceController::class, 'destroy'])->name('businesses.services.destroy');

    Route::get('/businesses/{business}/faqs', [FaqController::class, 'index'])->name('businesses.faqs.index');
    Route::post('/businesses/{business}/faqs', [FaqController::class, 'store'])->name('businesses.faqs.store');
    Route::patch('/businesses/{business}/faqs/{faq}', [FaqController::class, 'update'])->name('businesses.faqs.update');
    Route::delete('/businesses/{business}/faqs/{faq}', [FaqController::class, 'destroy'])->name('businesses.faqs.destroy');

    Route::patch('/businesses/{business}/leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('businesses.leads.status');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
