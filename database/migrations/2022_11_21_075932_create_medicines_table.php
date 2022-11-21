<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('medicine_code', 255)->nullable();
            $table->string('medicine_name', 255)->nullable();
            $table->unsignedInteger('medicine_price')->default(0);
            $table->unsignedInteger('medicine_profit')->default(0);
            $table->text('description')->nullable();
            $table->unsignedInteger('available_quantity')->default(0);
            $table->unsignedInteger('alert_quantity')->default(0);
            $table->string('status')->default('0');
            $table->foreignId('purchase_id')->constrained();
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
        Schema::dropIfExists('medicines');
    }
}
