<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EnterpriseController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\VisitorsController;
use App\Models\EnterpriseModel;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     print_r(session('user')['name']);
// });

Route::middleware('auth')->group(function(){
 Route::get('/get_session', function () {
        return session('user')['id'];
    });
    // Records
        Route::get('/', [RecordsController::class, 'records'])->name('home');
        Route::get('record/finish/{action}', [RecordsController::class, 'record_finish'])->name('record_finish');
        Route::get('finish_all', [RecordsController::class, 'finish_all'])->name('finish_all');

    //POSTS
        Route::post('record/visitor', [RecordsController::class, 'record_visitor'])->name('record_visitor');
        Route::post('get_records',[RecordsController::class, 'get_records'])->name('get_records');
    //End Records

    //Visitors
        Route::get('visitors', [VisitorsController::class, 'visitors'])->name('visitors');
        Route::get('get_profile/{id}',[VisitorsController::class, 'get_profile'])->name('get_profile');
        Route::get('visitor/delete/{id}', [VisitorsController::class, 'delete_visitor'])->name('delete_visitor');
    //POSTS
        Route::post('get_visitors', [VisitorsController::class, 'get_visitors'])->name('get_visitors');
        Route::post('edit_img_profile',[VisitorsController::class, 'edit_img_profile']);
        Route::post('edit_enterprise_visitor',[VisitorsController::class, 'edit_enterprise_visitor']);
        Route::post('visitor/add',[VisitorsController::class, 'add_visitor']);
          Route::post('visitor/edit',[VisitorsController::class, 'edit_visitor']);
    //End Visitors

    //Enterprise
        Route::get('enterprise', [EnterpriseController::class, 'enterprise'])->name('enterprise');
        Route::get('enterprise/delete/{id}', [EnterpriseController::class, 'delete_enterprise'])->name('delete_enterprise');
        Route::get('enterprises_json',[EnterpriseController::class, 'enterprises_json']);
        Route::get('enterprise/info/{id}',[EnterpriseController::class, 'info_enterprise'])->name('info_enterprise');

    //POSTS
        Route::post('get_enterprises',[EnterpriseController::class, 'get_enterprises'])->name('get_enterprises');
        Route::post('enterprise/add',[EnterpriseController::class, 'add_enterprise'])->name('add_enterprise');
        Route::post('enterprise/edit',[EnterpriseController::class, 'edit_enterprise']);
    //End Enterprise
    Route::middleware('checkProfile')->group(function(){
        //Destination
            Route::get('destination', [DestinationController::class, 'destination'])->name('destination');
            Route::get('destination/delete/{id}', [DestinationController::class, 'delete_destination'])->name('delete_destination');

        //POSTS
            Route::post('destination/add', [DestinationController::class, 'add_destination']);
            Route::post('get_destinations', [DestinationController::class, 'get_destinations'])->name('get_destinations');
        //End Destination

        //Reports
            Route::get('reports', [ReportsController::class, 'reports_filter'])->name('reports');

        //POSTS
            Route::post('get_reports', [ReportsController::class, 'get_reports'])->name('get_reports');
        //End Reports
    });
    //GET RECORDS DAY
        Route::get('get_records_history', function () {
            $tools = new App\Classes\Tools();
            $data = [
                'here' => count($tools->visitors_on_here()),
                'today' => count($tools->visitors_day())
            ];
            return $data;
        });


  });
