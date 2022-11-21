<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('vitals', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('systolic_b_p')->default(0);
            $table->unsignedInteger('diastolic_b_p')->default(0);
            $table->unsignedInteger('temperature')->default(0);
            $table->unsignedInteger('weight')->default(0);
            $table->unsignedInteger('height')->default(0);
            $table->unsignedInteger('pulse')->default(0);
            $table->unsignedInteger('respiratory_rate')->default(0);
            $table->unsignedInteger('heart_rate')->default(0);
            $table->unsignedInteger('urine_output')->default(0);
            $table->unsignedInteger('blood_sugar_r')->default(0);
            $table->unsignedInteger('blood_sugar_f')->default(0);
            $table->unsignedInteger('spo_2')->default(0);
            $table->string('avpu', 255)->nullable();
            $table->string('trauma', 255)->nullable();
            $table->string('mobility', 255)->nullable();
            $table->string('oxygen_supplement', 255)->nullable();
            $table->text('comment')->nullable();
            $table->string('status')->default('0');
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('patient_visit_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('vitals');
    }
}
