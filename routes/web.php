<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;

// Include the auth routes
require __DIR__ . '/auth.php';


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::group(['prefix' => 'admin','middleware' => ['auth']], function() {
    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'profile_edit'])->name('profile_edit');
    Route::post('/profile/update', [ProfileController::class, 'profile_update'])->name('profile_update');

    
    Route::get('/role-management', [RolePermissionController::class, 'index'])->name('role_management');
    Route::post('/role-management/add', [RolePermissionController::class, 'role_add'])->name('role_add');
    Route::get('/role-management/delete/{id}', [RolePermissionController::class, 'role_delete'])->name('role_delete');
    Route::post('/role-management/update', [RolePermissionController::class, 'role_update'])->name('role_update');
    Route::get('/get-role/{id}', [RolePermissionController::class, 'get_role'])->name('get_role');
    
    
    Route::post('/permission-management/add', [RolePermissionController::class, 'permission_add'])->name('permission_add');
    Route::get('/permission-management/delete/{id}', [RolePermissionController::class, 'permission_delete'])->name('permission_delete');
    Route::post('/permission-management/update', [RolePermissionController::class, 'permission_update'])->name('permission_update');
    Route::get('/get-permission/{id}', [RolePermissionController::class, 'get_permission'])->name('get_permission');
    Route::get('/fetch-permissions-by-role/{id}', [RolePermissionController::class, 'fetch_permissions'])->name('fetch_permissions_by_role');
    

    Route::post('/role-permission-assign', [RolePermissionController::class, 'role_permission_assign'])->name('role_permission_assign');
    Route::get('/role-permission-revoke/{id}', [RolePermissionController::class, 'role_permission_revoke'])->name('role_permission_revoke');

    Route::resource('users', UserController::class);
    

});