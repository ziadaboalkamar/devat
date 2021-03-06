<?php

use App\Events\myEvent;
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
use App\Http\Controllers\ProjectManagmentController;
use App\Http\Controllers\Setting2Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|

|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';







// Route::prefix('admin')->middleware('auth')->group(
//     function () {
//         //    home route
//         Route::get('/', [HomeController::class, 'index'])->name('admin');
//         //    start user
//         Route::get('/users', [UserController::class, 'index'])->name('users.index');
//         Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
//         Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
//         Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
//         Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('user.view');
//         Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
//         Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
//         Route::post('users/update_status', [UserController::class, 'updateStatus'])->name('users.update.status');
//         Route::get('/users/profile/{id}', [UserController::class, 'profile'])->name('users.destroy');
// =======
Route::prefix('admin')->middleware('auth')->group(
    function () {
        //    home route
        Route::get('/', [HomeController::class, 'index'])->name('admin');

        // Route::get('/',function(){
        //     event(new myEvent('hello world'));
        //     return view('dashboard.pages.home_page.index');
        // })->name('admin');
        
        //    start user
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('user.view');
        Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::post('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('users/update_status', [UserController::class, 'updateStatus'])->name('users.update.status');
        Route::get('/users/profile/{id}', [UserController::class, 'profile'])->name('user.profile');
        Route::post('users/update/profile/{id}', [UserController::class, 'updateProfile'])->name('user.update.profile');


        //    end user
        //    start roles route
        Route::get('/users/roles/{id}', [RoleController::class,'show'])->name('user.view.role');

        Route::get('/users/roles/update/{id}', [RoleController::class, 'update_role'])->name('user.role-update');

        //    end roles route

        Route::resource('main-branches', MainBrancheController::class);
        Route::resource('cities', CityController::class)->middleware('can:??????????');
        Route::resource('branches', BrancheController::class)->middleware('can:??????');
        Route::resource('category-of-projects', CategoryOfProjectController::class)->middleware('can:?????????? ???????????????? ??????????????');
        Route::resource('donors', DonorController::class)->middleware('can:???????????????? ??????????????');
        Route::resource('beneficiareis', BeneficiaryController::class)->middleware('can:????????????????????');
        Route::get('allBeneficiaries', [BeneficiaryController::class, 'allBeneficiaries'])->name('beneficiareis.allBeneficiaries')->middleware('can:??????????????????');

        Route::get('getbeneficiareis', [BeneficiariesProjectController::class, 'create'])->name('beneficiareis.get');
        Route::post('beneficiareis-projects/test/{id}', [BeneficiariesProjectController::class, 'store'])->name('beneficiareisProjects.store');
        Route::post('beneficiareis/projects/delete/{id}', [BeneficiariesProjectController::class, 'destroy'])->name('beneficiareisProjects.destroy');

        Route::resource('beneficiareis-projects', BeneficiariesProjectController::class)->middleware('can:???????????????? ??????????????');
        Route::post('update_status', [BeneficiaryController::class, 'updateStatus'])->name('update_status');
        Route::resource('vawtchers', VawtcherController::class)->middleware('can:??????????????');
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index')->middleware('can:??????????????????');
        Route::get('settings-tow', [Setting2Controller::class, 'index'])->name('settings2.index')->middleware('can:??????????????????');
        Route::post('update_setting', [SettingController::class, 'update'])->name('settings.update');
        Route::post('update_setting_tow', [Setting2Controller::class, 'update'])->name('settings2.update');
        Route::resource('roles', RoleController::class)->middleware('can:??????????????????');

        //    start project
        Route::middleware('can:????????????????')->group(function () {
            Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
            Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
            Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');
            Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
            Route::post('/projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
            Route::post('/projects/delete/attachment/{projectAttachment}', [ProjectController::class, 'deleteAttachment'])->name('projects.delete.attachment');
            Route::get('/projects/delete/attachment', [ProjectController::class, 'deleteaa'])->name('delete.attachment');
            Route::post('/projects/delete/{id}', [ProjectController::class, 'delete'])->name('projects.delete');
            Route::get('/projects/show/{id}', [ProjectController::class, 'show'])->name('projects.show');
            Route::get('/projects/all/beneficiareis/{id}', [ProjectController::class, 'allBenefactoryPoject'])->name('projects.beneficiareis.get.all');
            Route::post('projects/update_status', [ProjectController::class, 'updateStatus'])->name('projects.update.status');
            //    end project
            //    start branch Count
            Route::get('/projects/branchCount/{id}', [ProjectController::class, 'branchCount'])->name('projects.branchCount.index');
            Route::get('/projects/branch/Count/create', [BranchCountController::class, 'create'])->name('projects.branchCount.create');
            Route::post('projects/branch/count/store/{id}', [ProjectController::class, 'storeBranchCount'])->name('projects.branchCount.store');
            Route::get('/projects/branch/Count/edit/{id}', [BranchCountController::class, 'edit'])->name('projects.branchCount.edit');
            Route::post('/projects/branch/Count/update/{id}', [BranchCountController::class, 'update'])->name('projects.branchCount.update');
            Route::post('projects/branch/count/update_status', [BranchCountController::class, 'updateStatus'])->name('projects.branchCount.update.status');

            Route::post('projects/branch/count/delete', [BranchCountController::class, 'delete'])->name('projects.branchCount.delete');
            Route::get('/projects/branch/beneficiareis/{id}', [ProjectController::class, 'benefactoryPojectForBranch'])->name('projects.beneficiareis.get.for.branch');
            Route::get('projects/deleteImag/{id}',[ProjectController::class, 'deleteImag'])->name('projects.deleteImag');
            Route::post('projects/import_excel/import',[ProjectController::class, 'import'] )->name('import_excel.import');

        });

        Route::middleware('can:?????????? ???????????????? ??????????????')->group(function () {

            Route::get('/projects/management', [ProjectManagmentController::class, 'index'])->name('projects.management.index');
            Route::post('projects/management/update_status', [ProjectManagmentController::class, 'updateStatus'])->name('projects.management.update.status');
            Route::get('/projects/beneficiareis/{id}', [ProjectController::class, 'benefactoryPoject'])->name('projects.beneficiareis.get');
            Route::post('projects/submitAll/beneficiaries', [BeneficiariesProjectController::class, 'submitAll'])->name('projects.submit.all.beneficiaries');
            Route::post('projects/submitAll2/beneficiaries', [BeneficiariesProjectController::class, 'submitAll2'])->name('projects.submit.all2.beneficiaries');
        });
        //    end branch count
        Route::get('pro/beneficiareis/createBen',[BeneficiariesProjectController::class, 'createBen'])->name('beneficiareis.createBen');


    }

);
