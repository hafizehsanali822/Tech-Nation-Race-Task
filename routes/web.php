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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;


Auth::routes(['register' => false]);
Route::redirect('/', '/admin/races');
//Manage Admin Routes 
Route::group(['prefix' => 'admin/', 'middleware' => ['auth:web', 'checkadmin']], function(){
    Route::get('races', [AdminController::class, 'index'])->name('admin.index.races');
    Route::get('create-race', [AdminController::class, 'showCreateRaceForm'])->name('admin.show.race.form');
    Route::Post('create-race', [AdminController::class, 'storeRace'])->name('admin.create.race');
    Route::get('edit-race/{id}', [AdminController::class, 'showEditRaceForm'])->name('admin.edit.race.form');
    Route::Post('update-race', [AdminController::class, 'updateRace'])->name('admin.update.race');
    Route::get('annouce-winner', [AdminController::class, 'showRaceWinnerForm'])->name('admin.race.winner.form');
    Route::get('delete-race', [AdminController::class, 'deleteRace'])->name('admin.race.delete');
    Route::Post('annouce-winner', [AdminController::class, 'annouceRaceWinner'])->name('admin.race.annouce.winner');
    Route::get('admin-notifications', [AdminController::class, 'showAdminNotifications'])->name('admin.view.notifications');
    Route::post('send-push-notificaiton', [NotificationController::class, 'sendPushNotification'])->name('admin.send.push');
    Route::post('save-device-token', [NotificationController::class, 'saveDeviceToken'])->name('save.device.token');

});
