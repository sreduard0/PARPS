<?php

use App\Http\Controllers\EnterpriseController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\VisitorsController;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth')->group(function(){
    // Records
    Route::get('/', [RecordsController::class, 'records'])->name('home');
    Route::get('record/finish/{action}', [RecordsController::class, 'record_finish'])->name('record_finish');

    //POSTS
    Route::post('record/visitor', [RecordsController::class, 'record_visitor'])->name('record_visitor');
    Route::post('get_records',[RecordsController::class, 'get_records'])->name('get_records');
    //End Records

    //Visitors
        Route::get('get_profile/{id}',[VisitorsController::class, 'get_profile'])->name('get_profile');
    //End Visitors

    //Enterprise
        Route::get('enterprise', [EnterpriseController::class, 'enterprise'])->name('enterprise');
        Route::get('/enterprise/delete/{id}', [EnterpriseController::class, 'delete_enterprise'])->name('delete_enterprise');

    //POSTS
        Route::post('get_enterprises',[EnterpriseController::class, 'get_enterprises'])->name('get_enterprises');
    //End Enterprise


    Route::get('visitors', [ViewController::class, 'visitors'])->name('visitors');
    Route::get('reason', [ViewController::class, 'reason'])->name('reason');
    Route::get('destination', [ViewController::class, 'destination'])->name('destination');
    Route::get('reports_enterprise', [ViewController::class, 'reports_enterprise'])->name('reports_enterprise');
    Route::get('reports_visitors', [ViewController::class, 'reports_visitors'])->name('reports_visitors');
    Route::get('reports_date', [ViewController::class, 'reports_date'])->name('reports_date');

    //GET RECORDS DAY
    Route::get('get_records_history', function () {
        $tools = new App\Classes\Tools();
        $data = [
            'here' => count($tools->visitors_on_here()),
            'today' => count($tools->visitors_day())
        ];
        return $data;
    });
// });


