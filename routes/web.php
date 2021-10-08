<?php

use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth')->group(function(){
    Route::get('/', [ViewController::class, 'home'])->name('home');
    Route::get('enterprise', [ViewController::class, 'enterprise'])->name('enterprise');
    Route::get('visitors', [ViewController::class, 'visitors'])->name('visitors');
    Route::get('reason', [ViewController::class, 'reason'])->name('reason');
    Route::get('destiny', [ViewController::class, 'destiny'])->name('destiny');
    Route::get('reports_enterprise', [ViewController::class, 'reports_enterprise'])->name('reports_enterprise');
    Route::get('reports_visitors', [ViewController::class, 'reports_visitors'])->name('reports_visitors');
    Route::get('reports_date', [ViewController::class, 'reports_date'])->name('reports_date');
// });


