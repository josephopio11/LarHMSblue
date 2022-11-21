<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('sample_collections', function (Blueprint $table) {
            $table->id();
            $table->string('sample_code', 255)->nullable();
            $table->dateTime('collect_date')->nullable();
            $table->dateTime('receive_date')->nullable();
            $table->dateTime('dispatch_date')->nullable();
            $table->dateTime('cancel_dispatch_date')->nullable();
            $table->string('status')->default('0');
            $table->foreignId('investigation_id')->constrained();
            $table->foreignId('laboratory_id')->constrained();
            $table->foreignId('approved_by_id')->constrained('users');
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
        Schema::dropIfExists('sample_collections');
    }
}
