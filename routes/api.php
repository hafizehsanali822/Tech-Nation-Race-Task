<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/member-section', [MemberController::class, 'showMememberSection'])->name('member.portion'); 
Route::get('/member_login_form', [MemberController::class, 'showMemberLoginForm'])->name('member.login.form');
Route::post('/member_login', [MemberController::class, 'loginMember'])->name('member.login');
Route::get('/member_register_form', [MemberController::class, 'showMemberRegistrationForm'])->name('member.register.form');
Route::post('/register_member', [MemberController::class, 'registerMember'])->name('member.register'); 
Route::post('save-device-token', [NotificationController::class, 'saveDeviceToken'])->name('save.memeber.device.token');

   //Route::get('/member/register', [MemberController::class, 'showMemberRegistrationForm'])->name('member.register.form'); 
//Route::post('/register_member', [MemberController::class, 'registerMember'])->name('member.register'); 
   // Route::get('/member', [MemberController::class, 'showMemberLoginForm'])->name('member.login.form'); 
//Route::post('/member_login', [MemberController::class, 'loginMember'])->name('member.login');

Route::group(['middleware' => ['auth:api']], function(){
    Route::get('/member_logout', [MemberController::class, 'logoutMember'])->name('member.logout');  
    

    Route::get('/races', [MemberController::class  , 'getAllRaces'])->name('races.all');
    Route::post('/race/join', [MemberController::class  , 'joinRace'])->name('race.join');
    Route::post('/race/disjoin', [MemberController::class  , 'disJoinRace'])->name('race.disjoin');

   
});
