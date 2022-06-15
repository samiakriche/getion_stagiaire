<?php

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



Auth::routes();
Route::redirect('/', '/login');
//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/user/logout', [App\Http\Controllers\Auth\LoginController::class, 'userLogout'])->name('user.logout');
Route::get('/DemandeStage', [App\Http\Controllers\DemandeStageController::class, 'index'])->name('DemandeStage');
//stage/add-demande<
Route::get('/add-demande', [App\Http\Controllers\DemandeStageController::class, 'create']);
Route::post('/add-demande', [App\Http\Controllers\DemandeStageController::class, 'store']);

Route::get('/affecter_stage', [App\Http\Controllers\DemandeStageController::class, 'affecter_stage']);
Route::post('/affecter_stage', [App\Http\Controllers\DemandeStageController::class, 'affecter']);

Route::get('/Enseignants', [App\Http\Controllers\EnseignantController::class, 'index'])->name('Enseignants');
Route::get('/etudiants', [App\Http\Controllers\UserController::class, 'index'])->name('etudiants');
Route::get('/admin/dashboard',function () {
    return view('admin.dashboard');
})->name('admin_dashboard');

Route::get('user',function () {
    return view('user.index');
})->name('user_index');

Route::post('demande_stages_status/{id}', [App\Http\Controllers\DemandeStageController::class, 'status'])->name('demande_stages.status');
Route::post('demande_stages_encadrant/{id}', [App\Http\Controllers\DemandeStageController::class, 'encadrant'])->name('demande_stages.encadrant');
Route::get('document_download/{id}', [App\Http\Controllers\DocumentController::class, 'download'])->name('documents.download');
Route::get('user_profile/show', [App\Http\Controllers\UserProfileController::class, 'show'])->name('user_profile.show');
Route::get('user_profile/edit/{id}', [App\Http\Controllers\UserProfileController::class, 'edit'])->name('user_profile.edit');








/*Route::group(['prefix' => 'admin'], function() {
    Route::group(['middleware' => 'admin.guest'], function(){
        Route::view('/login','admin.login')->name('admin.login');
        Route::post('/login',[App\Http\Controllers\AdminController::class, 'authenticate'])->name('admin.auth');
    });
    
    Route::group(['middleware' => 'admin.auth'], function(){
        Route::get('/dashboard',[App\Http\Controllers\DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');

    });
});*/
/*
 * Enseignants Routes
 */
Route::resource('enseignants', App\Http\Controllers\EnseignantController::class);



/*
 * DemandeStages Routes
 */
Route::resource('demande_stages', App\Http\Controllers\DemandeStageController::class);

/*
 * Encadrants Routes
 */
Route::resource('encadrants', App\Http\Controllers\EncadrantController::class);

Route::view('admin', 'home');

/*
 * Documents Routes
 */
Route::resource('documents', App\Http\Controllers\DocumentController::class);

/*
 * UserProfiles Routes
 */
Route::resource('user_profiles', App\Http\Controllers\UserProfileController::class);

/*
 * Etudiants Routes
 */
Route::resource('etudiants', App\Http\Controllers\EtudiantController::class);
