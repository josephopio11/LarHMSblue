<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});


Route::resource('hospital-setting', App\Http\Controllers\HospitalSettingController::class);
Route::resource('branch', App\Http\Controllers\BranchController::class);
Route::resource('department', App\Http\Controllers\DepartmentController::class);
Route::resource('specialist', App\Http\Controllers\SpecialistController::class);
Route::resource('doctor', App\Http\Controllers\DoctorController::class);
Route::resource('nurse', App\Http\Controllers\NurseController::class);
Route::resource('patient', App\Http\Controllers\PatientController::class);
Route::resource('patient-visit', App\Http\Controllers\PatientVisitController::class);
Route::resource('patient-record', App\Http\Controllers\PatientRecordController::class);

Route::resource('schedule', App\Http\Controllers\ScheduleController::class);
Route::resource('laboratory', App\Http\Controllers\LaboratoryController::class);
Route::resource('radiology', App\Http\Controllers\RadiologyController::class);
Route::resource('blood-bank', App\Http\Controllers\BloodBankController::class);
Route::resource('operation-type', App\Http\Controllers\OperationTypeController::class);
Route::resource('operation', App\Http\Controllers\OperationController::class);
Route::resource('medicine-type', App\Http\Controllers\MedicineTypeController::class);
Route::resource('medicine-category', App\Http\Controllers\MedicineCategoryController::class);
Route::resource('supplier', App\Http\Controllers\SupplierController::class);
Route::resource('purchase', App\Http\Controllers\PurchaseController::class);
Route::resource('medicine', App\Http\Controllers\MedicineController::class);
Route::resource('prescription', App\Http\Controllers\PrescriptionController::class);
Route::resource('vital', App\Http\Controllers\VitalController::class);
Route::resource('allergy', App\Http\Controllers\AllergyController::class);
Route::resource('immunisation', App\Http\Controllers\ImmunisationController::class);
Route::resource('presenting-complaint', App\Http\Controllers\PresentingComplaintController::class);
Route::resource('diagnose', App\Http\Controllers\DiagnoseController::class);
Route::resource('blood-donor', App\Http\Controllers\BloodDonorController::class);
Route::resource('test-type', App\Http\Controllers\TestTypeController::class);
Route::resource('investigation', App\Http\Controllers\InvestigationController::class);
Route::resource('advice', App\Http\Controllers\AdviceController::class);
Route::resource('medical-certificate', App\Http\Controllers\MedicalCertificateController::class);
Route::resource('pharmacy', App\Http\Controllers\PharmacyController::class);
Route::resource('doctor-order', App\Http\Controllers\DoctorOrderController::class);
Route::resource('billing', App\Http\Controllers\BillingController::class);
Route::resource('billing-invoice', App\Http\Controllers\BillingInvoiceController::class);
Route::resource('billing-transaction', App\Http\Controllers\BillingTransactionController::class);
Route::resource('billing-invoice-detail', App\Http\Controllers\BillingInvoiceDetailController::class);
Route::resource('cheque-detail', App\Http\Controllers\ChequeDetailController::class);
Route::resource('sample-collection', App\Http\Controllers\SampleCollectionController::class);
Route::resource('ward', App\Http\Controllers\WardController::class);
Route::resource('room-type', App\Http\Controllers\RoomTypeController::class);
Route::resource('room', App\Http\Controllers\RoomController::class);
Route::resource('bed-type', App\Http\Controllers\BedTypeController::class);
Route::resource('bed', App\Http\Controllers\BedController::class);
Route::resource('pharmacy-invoice', App\Http\Controllers\PharmacyInvoiceController::class);
Route::resource('pharmacy-transaction', App\Http\Controllers\PharmacyTransactionController::class);
Route::resource('pharmacy-invoice-detail', App\Http\Controllers\PharmacyInvoiceDetailController::class);
Route::resource('blood-request', App\Http\Controllers\BloodRequestController::class);
Route::resource('blood-stock', App\Http\Controllers\BloodStockController::class);
Route::resource('blood-stock-detail', App\Http\Controllers\BloodStockDetailController::class);
Route::resource('blood-issue', App\Http\Controllers\BloodIssueController::class);
Route::resource('lab-test', App\Http\Controllers\LabTestController::class);
