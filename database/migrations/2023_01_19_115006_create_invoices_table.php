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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_customer_id');

            $table->string('invoice_number');
            $table->string('invoice_txn_reference');

            $table->timestamp('invoice_date');
            $table->timestamp('invoice_payment_due_date');
            $table->timestamp('invoice_payment_date');
            $table->bigInteger('invoice_amount');
            $table->enum('invoice_status', ['paid', 'unpaid'])->default('unpaid');

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
        Schema::dropIfExists('invoices');
    }
};
