<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('registration_no', 255)->nullable();
            $table->date('registration_date')->nullable();
            $table->enum('referral', ["Yes","No"])->default('No');
            $table->string('referred_by', 255)->nullable();
            $table->enum('patient_type', ["Inpatient","Outpatient"])->nullable();
            $table->enum('title', ["Mr","Mrs","Miss","Ms","Dr","Prof","Rev"])->nullable();
            $table->string('name', 255);
            $table->date('dob')->nullable();
            $table->enum('gender', ["M","F"])->default('M');
            $table->enum('marital_status', ["Single","Married","Divorced",""])->nullable();
            $table->enum('blood_group', ["A+","A-","B+","B-","AB+","AB-","O+","O-"])->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('religion', 255)->nullable();
            $table->string('occupation', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('home_phone', 255)->nullable();
            $table->text('home_address')->nullable();
            $table->string('fathers_name', 255)->nullable();
            $table->string('fathers_phone', 255)->nullable();
            $table->text('fathers_address')->nullable();
            $table->string('mothers_name', 255)->nullable();
            $table->string('mothers_phone', 255)->nullable();
            $table->text('mothers_address')->nullable();
            $table->string('same_as_patient')->default('0');
            $table->string('next_of_kin_phone', 255)->nullable();
            $table->string('next_of_kin_email', 255)->nullable();
            $table->text('next_of_kin_address')->nullable();
            $table->enum('payment_method', ["Cash","Card","Cheque"])->nullable();
            $table->text('symptoms')->nullable();
            $table->string('image', 255)->nullable();
            $table->foreignId('created_by_id')->constrained('users');
            $table->foreignId('updated_by_id')->constrained('users');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
