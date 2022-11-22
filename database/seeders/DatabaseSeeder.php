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
        User::factory(100)->create();
        HospitalSetting::factory(10)->create();
        Branch::factory(10)->create();
        Department::factory(10)->create();
        Specialist::factory(10)->create();
        Doctor::factory(10)->create();
        Nurse::factory(10)->create();
        Patient::factory(10)->create();
        PatientVisit::factory(10)->create();
        PatientRecord::factory(10)->create();
        Schedule::factory(10)->create();
        Laboratory::factory(10)->create();
        Radiology::factory(10)->create();
        BloodBank::factory(10)->create();
        OperationType::factory(10)->create();
        Operation::factory(10)->create();
        MedicineType::factory(10)->create();
        MedicineCategory::factory(10)->create();
        Supplier::factory(10)->create();
        Purchase::factory(10)->create();
        Medicine::factory(10)->create();
        Prescription::factory(10)->create();
        Vital::factory(10)->create();
        Allergy::factory(10)->create();
        Immunisation::factory(10)->create();
        PresentingComplaint::factory(10)->create();
        Diagnose::factory(10)->create();
        BloodDonor::factory(10)->create();
        TestType::factory(10)->create();
        Investigation::factory(10)->create();
        Advice::factory(10)->create();
        MedicalCertificate::factory(10)->create();
        Pharmacy::factory(10)->create();
        DoctorOrder::factory(10)->create();
        Billing::factory(10)->create();
        BillingInvoice::factory(10)->create();
        BillingTransaction::factory(10)->create();
        BillingInvoiceDetail::factory(10)->create();
        ChequeDetail::factory(10)->create();
        SampleCollection::factory(10)->create();
        Ward::factory(10)->create();
        RoomType::factory(10)->create();
        Room::factory(10)->create();
        BedType::factory(10)->create();
        Bed::factory(10)->create();
        PharmacyInvoice::factory(10)->create();
        PharmacyTransaction::factory(10)->create();
        PharmacyInvoiceDetail::factory(10)->create();
        BloodRequest::factory(10)->create();
        BloodStock::factory(10)->create();
        BloodStockDetail::factory(10)->create();
        BloodIssue::factory(10)->create();
        LabTest::factory(10)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
