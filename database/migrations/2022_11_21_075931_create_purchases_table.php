<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('code', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('type')->default('0');
            $table->string('medicine_generic_name', 255)->nullable();
            $table->string('medicine_unit', 255)->nullable();
            $table->string('medicine_strength', 255)->nullable();
            $table->string('medicine_shelf_life', 255)->nullable();
            $table->unsignedInteger('quantity')->default(0);
            $table->string('quantity_type', 255)->nullable();
            $table->unsignedInteger('price')->default(0);
            $table->date('expiry_date')->nullable();
            $table->text('note')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('status')->default('0');
            $table->foreignId('medicine_type_id')->constrained();
            $table->foreignId('medicine_category_id')->constrained();
            $table->foreignId('supplier_id')->constrained();
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
        Schema::dropIfExists('purchases');
    }
}
