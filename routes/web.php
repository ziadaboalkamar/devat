<?php

use App\Http\Controllers\BrancheController;
use App\Http\Controllers\CategoryOfProjectController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\MainBrancheController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\BeneficiariesProjectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VawtcherController;
use App\Http\Controllers\BranchCountController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|

|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';






Route::prefix('admin')->middleware('auth')->group(function () {
//    home route
    Route::get('/',[HomeController::class,'index'])->name('admin');
//    start user
    Route::get('/users',[UserController::class,'index'])->name('users.index');
    Route::get('/users/create',[UserController::class,'create'])->name('users.create');
    Route::post('/users/store',[UserController::class,'store'])->name('users.store');
    Route::get('/users/edit/{id}',[UserController::class,'edit'])->name('users.edit');
    Route::get('/users/edit/{id}',[UserController::class,'edit'])->name('user.view');
    Route::post('/users/update/{id}',[UserController::class,'update'])->name('users.update');
    Route::get('/users/delete/{id}',[UserController::class,'destroy'])->name('users.destroy');
    Route::post('users/update_status', [UserController::class, 'updateStatus'])->name('users.update.status');

   
//    end user
//    start roles route
    Route::get('/users/roles/{id}',[RoleController::class,'show_roles'])->name('user.view.role');
    Route::get('/users/roles/update/{id}',[RoleController::class,'update_role'])->name('user.role-update');

//    end roles route

Route::resource('main-branches', MainBrancheController::class);
Route::resource('cities', CityController::class);
Route::resource('branches', BrancheController::class);
Route::resource('category-of-projects',CategoryOfProjectController::class);
Route::resource('donors', DonorController::class);
Route::resource('beneficiareis', BeneficiaryController::class);
Route::post('beneficiareis-projects/store/test',[BeneficiariesProjectController::class,'store'])->name('beneficiareisProjects.store');
Route::resource('beneficiareis-projects', BeneficiariesProjectController::class);
Route::post('update_status', [BeneficiaryController::class, 'updateStatus'])->name('update_status');
Route::resource('vawtchers', VawtcherController::class);
Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::post('update_setting', [SettingController::class, 'update'])->name('settings.update');


//    start project
    Route::get('/projects',[ProjectController::class,'index'])->name('projects.index');
    Route::get('/projects/create',[ProjectController::class,'create'])->name('projects.create');
    Route::post('/projects/store',[ProjectController::class,'store'])->name('projects.store');
    Route::get('/projects/edit/{id}',[ProjectController::class,'edit'])->name('projects.edit');
    Route::post('/projects/update/{id}',[ProjectController::class,'update'])->name('projects.update');
    Route::post('/projects/delete/attachment/{id}',[ProjectController::class,'deleteAttachment'])->name('projects.delete.attachment');
    Route::get('/projects/delete/attachment',[ProjectController::class,'deleteaa'])->name('delete.attachment');
    Route::get('/projects/delete/{id}',[ProjectController::class,'delete'])->name('projects.delete');
    Route::get('/projects/show/{id}',[ProjectController::class,'show'])->name('projects.show');
    Route::get('/projects/beneficiareis/{id}',[ProjectController::class,'benefactoryPoject'])->name('projects.beneficiareis.get');
    Route::post('projects/update_status', [ProjectController::class, 'updateStatus'])->name('projects.update.status');
//    end project
//    start branch Count
    Route::get('/projects/branchCount/{id}',[ProjectController::class,'branchCount'])->name('projects.branchCount.index');
    Route::get('/projects/branch/Count/create',[BranchCountController::class,'create'])->name('projects.branchCount.create');
    Route::post('projects/branch/count/store/{id}',[ProjectController::class, 'storeBranchCount'])->name('projects.branchCount.store');
    Route::get('/projects/branch/Count/edit/{id}',[BranchCountController::class,'edit'])->name('projects.branchCount.edit');
    Route::post('/projects/branch/Count/update/{id}',[BranchCountController::class,'update'])->name('projects.branchCount.update');
    Route::post('projects/branch/count/update_status', [BranchCountController::class, 'updateStatus'])->name('projects.branchCount.update.status');

//    end branch count

}

    );

