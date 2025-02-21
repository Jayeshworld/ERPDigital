<?php

use App\Http\Controllers\Backend\Auth\AuthController;
use App\Http\Controllers\Backend\Auth\RolePermissionController;
use App\Http\Controllers\Backend\Masters\AccountTransferController;
use App\Http\Controllers\Backend\Masters\CategoryController;
use App\Http\Controllers\Backend\Masters\CompanyGuideController;
use App\Http\Controllers\Backend\Masters\DesignationProfileController;
use App\Http\Controllers\Backend\Masters\JdLeadAssignmentController;
use App\Http\Controllers\Backend\Masters\NotificationController;
use App\Http\Controllers\Backend\Masters\OtpController;
use App\Http\Controllers\Backend\Masters\PackagesController;
use App\Http\Controllers\Backend\Masters\PaymentGatewayController;
use App\Http\Controllers\Backend\Masters\VirtualNumbersController;
use App\Http\Controllers\Backend\Profile\ProfileController;
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



Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postRegister'])->name('postRegister');
Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('backend.admin.dashboard.dashboard');
    })->name('dashboard');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'viewProfile'])->name('viewProfile');
        Route::get('edit', [ProfileController::class, 'editProfile'])->name('editProfile');
        Route::put('update', [ProfileController::class, 'updateProfile'])->name('updateProfile');
        Route::get('change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
        Route::put('update-password', [ProfileController::class, 'updatePassword'])->name('updatePassword');
    });

    Route::prefix('masters')->group(function () {
        Route::prefix('category')->group(function () {
            Route::get('form', [CategoryController::class, 'categoryForm'])->name('categoryForm');
            Route::get('view', [CategoryController::class, 'categoryView'])->name('categoryView');
            Route::post('store', [CategoryController::class, 'storeCategory'])->name('category.store');
            Route::put('/update/{id}', [CategoryController::class, 'updateCategory'])->name('category.update');
            Route::get('edit/{id}', [CategoryController::class, 'editCategory'])->name('category.edit');
            Route::DELETE('delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category.destroy');
            Route::put('/toggle-status/{id}', [CategoryController::class, 'toggleStatus'])->name('category.toggleStatus');
        });

        Route::prefix('packages')->group(function () {
            Route::get('form', [PackagesController::class, 'packageForm'])->name('packageForm');
            Route::get('view', [PackagesController::class, 'viewPackage'])->name('viewPackage');
            Route::post('store', [PackagesController::class, 'storePackage'])->name('package.store');
            Route::put('/update/{id}', [PackagesController::class, 'update'])->name('package.update');
            Route::get('edit/{id}', [PackagesController::class, 'edit'])->name('package.edit');
            Route::DELETE('delete/{id}', [PackagesController::class, 'destroy'])->name('package.destroy');
            Route::put('/toggle-status/{id}', [PackagesController::class, 'toggleStatus'])->name('package.toggleStatus');
        });

        Route::prefix('guidelines')->group(function () {
            Route::get('form', [CompanyGuideController::class, 'guidelinesForm'])->name('guidelinesForm');
            Route::get('view', [CompanyGuideController::class, 'viewGuidelines'])->name('viewGuidelines');
            Route::post('store', [CompanyGuideController::class, 'storeGuidelines'])->name('guidelines.store');
            Route::put('/update/{id}', [CompanyGuideController::class, 'updateGuidelines'])->name('guidelines.update');
            Route::get('edit/{id}', [CompanyGuideController::class, 'editGuidelines'])->name('guidelines.edit');
            Route::DELETE('delete/{id}', [CompanyGuideController::class, 'deleteGuidelines'])->name('guidelines.destroy');
        });

        Route::prefix('virtual-numbers')->group(function () {
            Route::get('view', [VirtualNumbersController::class, 'viewVirtualNumbers'])->name('viewVirtualNumbers');
            Route::get('create', [VirtualNumbersController::class, 'create'])->name('manageVMN');
            Route::post('store', [VirtualNumbersController::class, 'process'])->name('storeVMN');
            Route::get('edit/{id}', [VirtualNumbersController::class, 'edit'])->name('virtualRecord.edit');
            Route::put('update/{id}', [VirtualNumbersController::class, 'update'])->name('virtual.update');
            Route::delete('delete/{id}', [VirtualNumbersController::class, 'delete'])->name('virtualRecord.destroy');
            Route::put('toggle-status/{id}', [VirtualNumbersController::class, 'toggleStatus'])->name('virtualRecord.toggleStatus');
        });
        Route::prefix('otp-details')->group(function () {
            Route::get('view', [OtpController::class, 'viewOTPRecords'])->name('otpDetails');
        });

        Route::prefix('transfer-accounts')->group(function () {
            Route::get('view', [AccountTransferController::class, 'transferAccounts'])->name('transferAccounts');
        });

        Route::prefix('assign-jd-leads')->group(function () {
            Route::get('view', [JdLeadAssignmentController::class, 'assignJDLeads'])->name('assignJDLeads');
        });

        Route::prefix('notifications')->group(function () {
            Route::get('view', [NotificationController::class, 'notifications'])->name('notifications');
        });
        Route::prefix('payment-gateway')->group(function () {
            Route::get('view', [PaymentGatewayController::class, 'paymentGateway'])->name('paymentGateway');
        });

        Route::prefix('designations')->group(function () {
            Route::get('form', [DesignationProfileController::class, 'createDesignation'])->name('designationForm');
            Route::get('view', [DesignationProfileController::class, 'viewDesignation'])->name('designationView');
            Route::post('store', [DesignationProfileController::class, 'storeDesignation'])->name('designation.store');
            Route::get('edit/{id}', [DesignationProfileController::class, 'editDesignation'])->name('designation.edit');
            Route::put('update/{id}', [DesignationProfileController::class, 'updateDesignation'])->name('designation.update');
            Route::DELETE('delete/{id}', [DesignationProfileController::class, 'deleteDesignation'])->name('designation.destroy');
            Route::put('toggle-status/{id}', [DesignationProfileController::class, 'toggleStatus'])->name('designation.toggleStatus');
        });

        Route::prefix('profiles')->group(function () {
            Route::get('form', [DesignationProfileController::class, 'createProfile'])->name('profileForm');
            Route::get('view', [DesignationProfileController::class, 'viewProfile'])->name('profileView');
            Route::post('store', [DesignationProfileController::class, 'storeProfile'])->name('profile.store');
            Route::get('edit/{id}', [DesignationProfileController::class, 'editProfile'])->name('profile.edit');
            Route::put('update/{id}', [DesignationProfileController::class, 'updateProfile'])->name('profile.update');
            Route::DELETE('delete/{id}', [DesignationProfileController::class, 'deleteProfile'])->name('profile.destroy');
            Route::put('toggle-status/{id}', [DesignationProfileController::class, 'toggleStatus'])->name('profile.toggleStatus');
        });
    });
    Route::get('/roles', [RolePermissionController::class, 'index'])->name('roles.index');
    Route::post('/roles/create', [RolePermissionController::class, 'storeRole'])->name('roles.store');
    Route::post('/permissions/create', [RolePermissionController::class, 'storePermission'])->name('permissions.store');
    Route::post('/roles/{role}/assign-permissions', [RolePermissionController::class, 'assignPermissions'])->name('roles.assign.permissions');
    Route::post('/users/{user}/assign-role', [RolePermissionController::class, 'assignRole'])->name('users.assign.role');
    Route::post('/users/{user}/assign-permission', [RolePermissionController::class, 'assignPermission'])->name('users.assign.permission');
});