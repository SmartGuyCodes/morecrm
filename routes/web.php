<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\ItemController;
use App\Http\Controllers\Client\ReceivingController;
use App\Http\Controllers\Client\ReportsController;
use App\Http\Controllers\Client\RequisitionController;
use App\Http\Controllers\Client\SettingsController;
use App\Http\Controllers\Client\SuppliersController;
use App\Http\Controllers\Client\StaffController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;
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
// LANDING PAGE
Route::get('/', function () {
    return view('landing.index', [
        'saas_name' => 'MoreCRM',
        'title' => 'MoreCRM - Home',
        'description' => 'Simply easy!'
    ]);
});


// SUBSCRIBED CLIENT URLS
// AUTHENTICATION
//1. Registration UJ
Route::get('/subscribe', [AuthController::class, 'subscribe_client']);
Route::post('/client-subscription', [AuthController::class, 'register_client']);
Route::get('/subscription-paywall', function () {
    return view('auth.invoice');
});
Route::get('/verify-subscription', [AuthController::class, 'verify_subscription']);
Route::post('/authenticate-client', [AuthController::class, 'authenticate_client']);

//2. Login UJ
Route::get('/login', [AuthController::class, 'login_client_page']);
Route::post('/sign-in', [AuthController::class, 'login_client']);

// 3. Forgot Password UJ
Route::get('/forget-password', [ForgotPasswordController::class, 'show_forget_password_form']);
Route::post('/forget-password', [ForgotPasswordController::class, 'submit_forget_password_form']);
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'show_reset_password_form'])->name('reset.password.get');
Route::post('/reset-password', [ForgotPasswordController::class, 'submit_reset_password_form']);

// 4. Client dashboard
Route::get('/client-dashboard', [DashboardController::class, 'index']);

// 5. Client categories
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/add-category', [CategoryController::class, 'add_category']);
Route::post('/update-category/{category_id}', [CategoryController::class, 'update_category']);
Route::get('/delete-category/{category_id}', [CategoryController::class, 'delete_category']);

// 6. SUpplier Suppliers
Route::get('/suppliers', [SuppliersController::class, 'index']);
Route::post('/add-supplier', [SuppliersController::class, 'add_supplier']);
Route::post('/update-supplier/{supplier_id}', [SuppliersController::class, 'update_supplier']);
Route::get('/delete-supplier/{supplier_id}', [SuppliersController::class, 'delete_supplier']);

// 6. Client items
Route::get('/items', [ItemController::class, 'index']);
Route::get('/item', [ItemController::class, 'index']);
Route::post('/add-item', [ItemController::class, 'add_item']);
Route::post('/update-item/{item_id}', [ItemController::class, 'update_item']);
Route::get('/delete-item/{item_id}', [ItemController::class, 'delete_item']);

// 8. Client Requisitions
Route::get('/requisitions', [RequisitionController::class, 'index']);
Route::post('/add-requisition', [RequisitionController::class, 'add_requisition']);
Route::post('/update-requisition/{requisition_id}', [RequisitionController::class, 'update_requisition']);
Route::get('/delete-requisition/{requisition_lpo_number}', [RequisitionController::class, 'delete_requisition']);

// 9. Receivings
Route::get('/receiving-listings', [ReceivingController::class, 'receiving_listings']);
Route::get('/receiving-profile/{receiving_grn}', [ReceivingController::class, 'receiving_profile']);
Route::get('/display-grn-pdf/{grn_no}', [ReceivingController::class, 'display_grn_pdf']);//display_grn_pdf
Route::post('/update-receiving/{uuid}', [ReceivingController::class, 'update_receiving']);
Route::get('/delete-receiving/{uuid}', [ReceivingController::class, 'delete_receiving']);
Route::get('/receive/{grn}', [ReceivingController::class, 'index']);
Route::post('/add-receiving-item', [ReceivingController::class, 'add_receiving_item']);
Route::get('/delete_receiving_item/{id}', [ReceivingController::class, 'delete_receiving_item']);
Route::post('/register-receiving', [ReceivingController::class, 'register_receiving']);
Route::get('/delete_receiving_item/{id}', [ReceivingController::class, 'delete_receiving_item']);
Route::get('/delete_receiving/{id}', [ReceivingController::class, 'delete_receiving_item']);

// 10. Reports
Route::get('/suppliers-list', [ReportsController::class, 'suppliers_list']); //suppliers_list
Route::get('/suppliers-list-pdf', [ReportsController::class, 'suppliers_list_pdf']); //suppliers_list
Route::post('/filter-suppliers-list', [ReportsController::class, 'suppliers_filtered_list']);
Route::get('/suppliers-list-pdf-filtered/{start_date}/{end_date}', [ReportsController::class, 'suppliers_list_pdf_filtered']); //suppliers_list

Route::get('/suppliers-report', [ReportsController::class, 'suppliers_report']); //suppliers_report

Route::get('/items-list', [ReportsController::class, 'items_list']); //items_list
Route::get('/items-list-pdf', [ReportsController::class, 'items_list_pdf']); //suppliers_listzz
Route::post('/filter-items-list', [ReportsController::class, 'items_filtered_list']);
Route::get('/items-list-pdf-filtered/{start_date}/{end_date}', [ReportsController::class, 'items_list_pdf_filtered']); //suppliers_list

Route::get('/grn-report', [ReportsController::class, 'grn_report']); //grn_report
Route::get('/grn-report-pdf', [ReportsController::class, 'grn_report_pdf']); //suppliers_listzz
Route::post('/filter-grn-report', [ReportsController::class, 'grn_filtered_report']);
Route::get('/grn-report-pdf-filtered/{start_date}/{end_date}', [ReportsController::class, 'grn_report_pdf_filtered']); //suppliers_list

Route::get('/requisition-report', [ReportsController::class, 'requisition_report']); //requisition_report
Route::get('/requisition-report-pdf', [ReportsController::class, 'requisition_report_pdf']); //suppliers_listzz
Route::post('/filter-requisition-report', [ReportsController::class, 'requisition_filtered_report']);
Route::get('/requisition-report-pdf-filtered/{start_date}/{end_date}', [ReportsController::class, 'requisition_report_pdf_filtered']);

// 11. Settings
Route::get('/settings', [SettingsController::class, 'index']);

// 12. Staff
Route::get('/staff', [StaffController::class, 'index']);
Route::post('/add-staff', [StaffController::class, 'add_staff']);
Route::post('/update-staff/{staff_id}', [StaffController::class, 'update_staff']);
Route::get('/delete-staff/{staff_id}', [StaffController::class, 'delete_staff']);
Route::post('/send-sms/{phone}', [StaffController::class, 'sms_staff']);
Route::post('/send-email/{email}', [StaffController::class, 'email_staff']);

// ADMIN
Route::get('/admin-dashboard', function(){
    return view('admin.dashboard');
});

Route::get('/admin-clients', function(){
    return view('admin.clients');
});

//Logout
Route::get('/logout', [AuthController::class, 'logout_client']);