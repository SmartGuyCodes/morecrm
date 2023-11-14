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
        Schema::create('receivings', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->bigInteger("uuid");
            $table->string('receiving_grn');
            $table->integer('receiving_supplier_id');
            $table->string('receiving_voucher_no');
            $table->string('received_by');
            $table->string('receiving_department');
            $table->string('receiving_mode');
            $table->string('receiving_notes');
            $table->timestamp('receiving_date_time');
            $table->integer('receiving_products_qty');

            $table->bigInteger('total_paid_amount');
            $table->bigInteger('balance_due');
            $table->string('txn_ref');

            $table->string('payment_method');

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
        Schema::dropIfExists('receivings');
    }
};
