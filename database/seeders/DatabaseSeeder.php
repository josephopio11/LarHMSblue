<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bed;
use App\Models\Room;
use App\Models\User;
use App\Models\Ward;
use App\Models\Nurse;
use App\Models\Vital;
use App\Models\Advice;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Allergy;
use App\Models\BedType;
use App\Models\Billing;
use App\Models\LabTest;
use App\Models\Patient;
use App\Models\Diagnose;
use App\Models\Medicine;
use App\Models\Pharmacy;
use App\Models\Purchase;
use App\Models\RoomType;
use App\Models\Schedule;
use App\Models\Supplier;
use App\Models\TestType;
use App\Models\BloodBank;
use App\Models\Operation;
use App\Models\Radiology;
use App\Models\BloodDonor;
use App\Models\BloodIssue;
use App\Models\BloodStock;
use App\Models\Department;
use App\Models\Laboratory;
use App\Models\Specialist;
use App\Models\DoctorOrder;
use App\Models\BloodRequest;
use App\Models\ChequeDetail;
use App\Models\Immunisation;
use App\Models\MedicineType;
use App\Models\PatientVisit;
use App\Models\Prescription;
use App\Models\Investigation;
use App\Models\OperationType;
use App\Models\PatientRecord;
use App\Models\BillingInvoice;
use App\Models\HospitalSetting;
use App\Models\PharmacyInvoice;
use Illuminate\Database\Seeder;
use App\Models\BloodStockDetail;
use App\Models\MedicineCategory;
use App\Models\SampleCollection;
use App\Models\BillingTransaction;
use App\Models\MedicalCertificate;
use App\Models\PharmacyTransaction;
use App\Models\PresentingComplaint;
use App\Models\BillingInvoiceDetail;
use App\Models\PharmacyInvoiceDetail;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // $this->call(PermissionSeeder::class);
        // $this->call(RolesAndPermissionsSeeder::class);
        // User::factory(10)->create();
        // HospitalSetting::factory(100)->create();
        // Branch::factory(100)->create();
        // Department::factory(100)->create();
        // Specialist::factory(100)->create();
        // Doctor::factory(100)->create();
        // Nurse::factory(100)->create();
        // Patient::factory(100)->create();
        // PatientVisit::factory(100)->create();
        // PatientRecord::factory(100)->create();
        // Schedule::factory(100)->create();
        // Laboratory::factory(100)->create();
        // Radiology::factory(100)->create();
        // BloodBank::factory(100)->create();
        // OperationType::factory(100)->create();
        // Operation::factory(100)->create();
        // MedicineType::factory(100)->create();
        // MedicineCategory::factory(100)->create();
        // Supplier::factory(100)->create();
        // Purchase::factory(100)->create();
        // Medicine::factory(100)->create();
        // Prescription::factory(100)->create();
        // Vital::factory(100)->create();
        // Allergy::factory(100)->create();
        // Immunisation::factory(100)->create();
        // PresentingComplaint::factory(100)->create();
        // Diagnose::factory(100)->create();
        // BloodDonor::factory(100)->create();
        // TestType::factory(100)->create();
        // Investigation::factory(100)->create();
        // Advice::factory(100)->create();
        // MedicalCertificate::factory(100)->create();
        // Pharmacy::factory(100)->create();
        // DoctorOrder::factory(100)->create();
        Billing::factory(100)->create();
        BillingInvoice::factory(100)->create();
        BillingTransaction::factory(100)->create();
        BillingInvoiceDetail::factory(100)->create();
        ChequeDetail::factory(100)->create();
        SampleCollection::factory(100)->create();
        Ward::factory(100)->create();
        RoomType::factory(100)->create();
        Room::factory(100)->create();
        BedType::factory(100)->create();
        // Bed::factory(100)->create();
        // PharmacyInvoice::factory(100)->create();
        // PharmacyTransaction::factory(100)->create();
        // PharmacyInvoiceDetail::factory(100)->create();
        // BloodRequest::factory(100)->create();
        // BloodStock::factory(100)->create();
        // BloodStockDetail::factory(100)->create();
        // BloodIssue::factory(100)->create();
        // LabTest::factory(100)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
