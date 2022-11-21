<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('website', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('fax', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->date('extablished')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('favicon', 255)->nullable();
            $table->string('size', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('whatsapp', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('driver', 255)->nullable();
            $table->string('encryption', 255)->nullable();
            $table->string('host', 255)->nullable();
            $table->string('port', 255)->nullable();
            $table->string('username', 255)->nullable();
            $table->string('email_from', 255)->nullable();
            $table->string('email_from_name', 255)->nullable();
            $table->string('invoice_prefix', 255)->nullable();
            $table->string('invoice_logo', 255)->nullable();
            $table->string('user_prefix', 255)->nullable();
            $table->string('patient_prefix', 255)->nullable();
            $table->string('invoice_number_mode', 255)->nullable();
            $table->string('invoice_last_number', 255)->nullable();
            $table->string('taxes', 255)->nullable();
            $table->string('discount', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospital_settings');
    }
}
