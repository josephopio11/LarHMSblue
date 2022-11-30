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
        $this->call(UserSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        User::factory(10)->create();
        HospitalSetting::factory(1)->create();
        Branch::factory(1)->create();
        Department::factory(1)->create();
        Specialist::factory(1)->create();
        Doctor::factory(1)->create();
        Nurse::factory(1)->create();
        Patient::factory(1)->create();
        PatientVisit::factory(1)->create();
        PatientRecord::factory(1)->create();
        Schedule::factory(1)->create();
        Laboratory::factory(1)->create();
        Radiology::factory(1)->create();
        BloodBank::factory(1)->create();
        OperationType::factory(1)->create();
        Operation::factory(1)->create();
        MedicineType::factory(1)->create();
        MedicineCategory::factory(1)->create();
        Supplier::factory(1)->create();
        Purchase::factory(1)->create();
        Medicine::factory(1)->create();
        Prescription::factory(1)->create();
        Vital::factory(1)->create();
        Allergy::factory(1)->create();
        Immunisation::factory(1)->create();
        PresentingComplaint::factory(1)->create();
        Diagnose::factory(1)->create();
        BloodDonor::factory(1)->create();
        TestType::factory(1)->create();
        Investigation::factory(1)->create();
        Advice::factory(1)->create();
        MedicalCertificate::factory(1)->create();
        Pharmacy::factory(1)->create();
        DoctorOrder::factory(1)->create();
        Billing::factory(1)->create();
        BillingInvoice::factory(1)->create();
        BillingTransaction::factory(1)->create();
        BillingInvoiceDetail::factory(1)->create();
        ChequeDetail::factory(1)->create();
        SampleCollection::factory(1)->create();
        Ward::factory(1)->create();
        RoomType::factory(1)->create();
        Room::factory(1)->create();
        BedType::factory(1)->create();
        Bed::factory(1)->create();
        PharmacyInvoice::factory(1)->create();
        PharmacyTransaction::factory(1)->create();
        PharmacyInvoiceDetail::factory(1)->create();
        BloodRequest::factory(1)->create();
        BloodStock::factory(1)->create();
        BloodStockDetail::factory(1)->create();
        BloodIssue::factory(1)->create();
        LabTest::factory(1)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
