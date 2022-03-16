<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\UserController;
use App\Models\Couple;
use App\Models\Person;

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

Route::get('/keturunan', function () {
    // $data = Person::find(12)->marriages()->get();
    $dataHery = Person::find(3)->marriages()->with('personHusband', 'personWife', 'descendants')
        ->withCount('descendants')->get();



    $data = $dataHery;
    // foreach ($dataHery as $hery) { //patokan pengulangan itu ke jumlah pernikahan

    //     if ($hery->personHusband) {
    //         $husbandName = $hery->personHusband->name;
    //     }

    //     $data[] = [
    //         'Suami' => $husbandName,
    //     ];
    // }

    // $data = str_repeat("'descendants',", 2);
    $dataJson = [
        'data' => $data,
        'time' => round(microtime(true) - LARAVEL_START, 3)
    ];

    return response()->json($dataJson);
});

Route::get('/test', [TestingController::class, 'index'])->name('testing');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('root');
});


Auth::routes();

/**
 * PROFILE
 */

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
/**
 * ./PROFILE
 */


/**
 * PERSON
 */
Route::prefix('person')->middleware(['auth'])->group(function () {
    Route::get('/', [PersonController::class, 'index'])->name('person');
    Route::get('/create', [PersonController::class, 'create'])->name('person.create')->middleware(['permission:person create']);
    Route::get('/profile/{id}/view', [PersonController::class, 'show'])->name('person.show');
    Route::get('/tree', [PersonController::class, 'tree'])->name('person.tree');
});


/**
 * ./END PERSON
 */







Route::group(['middleware' => ['role:super admin|admin']], function () {

    /** USER ROUTE */
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/user/datatable', [UserController::class, 'datatable'])->name('user.datatable');
    Route::post('/user', [UserController::class, 'store'])->name('user.store')->middleware(['permission:user create']);
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{id}/delete', [UserController::class, 'delete'])->name('user.delete')->middleware(['permission:user delete']);
    /**
     * ./END USER ROUTE
     */

    //trash
    Route::get('/user/trash', [UserController::class, 'trash'])->name('user.trash');
    Route::post('/user/datatabletrash', [UserController::class, 'datatableTrash'])->name('user.trashDatatable');
    Route::post('/user/{id}/restore', [UserController::class, 'restore'])->name('user.restore');
    Route::delete('/user/{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');

    /** ACTIVITIES */
    Route::get('/activity', [ActivityController::class, 'index'])->name('activity');
    Route::post('/activity/datatable', [ActivityController::class, 'datatable'])->name('activity.datatable');
    Route::get('/activity/{activity}/show', [ActivityController::class, 'show'])->name('activity.show');


    Route::get('/rolepermission', [RolePermissionController::class, 'index'])->name('rolepermission');

    /**
     * ROLE PROCESS
     */
    Route::post('/role', [RolePermissionController::class, 'storeRole'])->name('role.store');
    Route::get('/role/{id}/edit', [RolePermissionController::class, 'editRole'])->name('role.edit');
    Route::patch('/role/{id}/update', [RolePermissionController::class, 'updateRole'])->name('role.update');
    Route::delete('/role/{id}/delete', [RolePermissionController::class, 'deleteRole'])->name('role.delete');
    Route::post('/role/datatable', [RolePermissionController::class, 'datatableRoles'])->name('role.datatable');


    /** PERMISSIONS PROCESS */
    Route::post('/permission', [RolePermissionController::class, 'storePermission'])->name('permission.store');
    Route::get('/permission/{id}/edit', [RolePermissionController::class, 'editPermission'])->name('permission.edit');
    Route::patch('/permission/{id}/update', [RolePermissionController::class, 'updatePermission'])->name('permission.update');
    Route::delete('/permission/{id}/delete', [RolePermissionController::class, 'deletePermission'])->name('permission.delete');
    Route::post('/permission/datatable', [RolePermissionController::class, 'datatablePermissions'])->name('permission.datatable');


    /** ASSIGN PROCESS */
    Route::get('/assignpermission', [RolePermissionController::class, 'assign'])->name('assignPermission.assign');
    Route::get('/assignpermission/{id}/viewpermission', [RolePermissionController::class, 'viewPermissions'])->name('assignPermission.viewPermissions');
    Route::post('/assignpermission', [RolePermissionController::class, 'storeAssign'])->name('assignPermission.store');
    Route::post('/assignpermission/datatable', [RolePermissionController::class, 'datatableAssign'])->name('assignPermission.datatable');
});
