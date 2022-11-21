<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('beds', function (Blueprint $table) {
            $table->id();
            $table->string('bed_no', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->unsignedInteger('price')->default(0);
            $table->string('status')->default('0');
            $table->string('image', 255)->nullable();
            $table->foreignId('room_id')->constrained();
            $table->foreignId('bed_type_id')->constrained();
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
        Schema::dropIfExists('beds');
    }
}
