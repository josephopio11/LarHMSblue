<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roleaccesses', function (Blueprint $table) {
            /**
             * role_name
             * module
             * can_create
             * can_read
             * can_update
             * can_delete
             * can_import
             * can_export
             */
            $table->id();
            $table->string('role_name');
            $table->string('module');
            $table->string('can_create');
            $table->string('can_read');
            $table->string('can_update');
            $table->string('can_delete');
            $table->string('can_import');
            $table->string('can_export');
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
        Schema::dropIfExists('roleaccesses');
    }
};
