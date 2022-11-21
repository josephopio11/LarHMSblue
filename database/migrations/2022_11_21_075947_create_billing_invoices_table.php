<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('billing_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no', 255)->nullable();
            $table->unsignedInteger('total')->default(0);
            $table->unsignedInteger('pending_amount')->default(0);
            $table->unsignedInteger('paid_amount')->default(0);
            $table->string('mode')->default('0');
            $table->string('discount_type', 255)->nullable();
            $table->unsignedInteger('discount_amount')->default(0);
            $table->string('discount_note', 255)->nullable();
            $table->text('note')->nullable();
            $table->unsignedInteger('tax')->default(0);
            $table->unsignedInteger('additional_charge')->default(0);
            $table->string('status')->default('0');
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('patient_visit_id')->constrained();
            $table->foreignId('doctor_order_id')->constrained();
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
        Schema::dropIfExists('billing_invoices');
    }
}
