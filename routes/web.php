<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectCollaboratorController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectIssueController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');


// Get each project
Route::get('/project{id}', [ProjectController::class, 'index'])->middleware(['auth'])->name('project');


/**
 * Web APIs
 */
Route::prefix('app')->middleware(['auth'])->group(function(){

    /**
     *  Projects
     */
    Route::post('/create_new_project', [ProjectController::class, 'create']);
    Route::get('/get_my_projects', [ProjectController::class, 'show']);
    Route::get('/get_other_projects', [ProjectController::class, 'showOthers']);
    
   /**
    * Issues Tracker 
   */
  Route::get('/get_all_project_issues/{id}', [ProjectIssueController::class, 'index']); 
  Route::get('/get_project_author/{id}', [ProjectIssueController::class, 'showAuthor']);
  Route::post('/create_new_issue', [ProjectIssueController::class, 'create']);  
  Route::put('/update_issue_module', [ProjectIssueController::class, 'updateModule']); 
  Route::put('/update_issue_qa_status', [ProjectIssueController::class, 'updateQaStat']); 
  Route::put('/update_issue_dev_status', [ProjectIssueController::class, 'updateDevStat']);
  Route::put('/update_issue_qa_user', [ProjectIssueController::class, 'updateQaUser']);
  Route::put('/update_issue_dev_user', [ProjectIssueController::class, 'updateDevUser']);
  Route::put('/update_issue_date_logged', [ProjectIssueController::class, 'updateDateLogged']);
  Route::put('/update_issue_date_fixed', [ProjectIssueController::class, 'updateDateFixed']);
  
  

  /**
   * Project Collaborators
   */
  Route::get('/get_project_collaborators/{id}', [ProjectCollaboratorController::class, 'index']); 
  Route::get('/get_search_users/{email}', [ProjectCollaboratorController::class, 'showUsers']);
  Route::put('/add_collaborator_to_project', [ProjectCollaboratorController::class, 'create']);  
  
   
});


// Route::middleware(['auth'])->get('{any}', function () {
//     return view('project');
// })->where( 'any','.*');

require __DIR__.'/auth.php';
