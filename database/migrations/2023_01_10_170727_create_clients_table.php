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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('company_subscription_package');
            $table->string('company_name')->unique();
            $table->string('company_email')->unique();
            $table->integer('otp_code');
            $table->boolean('otp_verified')->default(false);
            $table->boolean('is_active')->default(false);
            $table->string('company_phone');
            $table->string('company_address');
            $table->string('company_contact_person_name');
            $table->string('company_contact_person_phone');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('clients');
    }
};
