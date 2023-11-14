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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');

            $table->string('company_name');
            $table->string('company_postal_address');
            $table->string('company_physical_address');
            $table->string('company_email');
            $table->string('company_phone_no');
            $table->string('company_contact_person');
            $table->string('company_contact_person_email');
            $table->string('company_contact_person_phone');

            // $table->enum('supplier_type', ['local', 'international'])->default('local');
            $table->enum('supplier_status', ['active', 'inactive'])->default('active');
            $table->bigInteger('supplier_balance')->default(0); //the amount owed to the supplier by the company
            $table->bigInteger('supplier_paid_balance')->default(0); //the amount paid to the supplier by the company

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
        Schema::dropIfExists('suppliers');
    }
};
