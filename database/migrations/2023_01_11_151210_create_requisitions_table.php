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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->enum('requisition_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('requisition_lpo_number');
            $table->string('requisition_title');
            $table->string('requisition_item_name');
            $table->bigInteger('requisition_item_stock_level');
            $table->string('requisition_urgency');
            $table->timestamp('requisition_date');
            $table->string('requisition_department');
            $table->bigInteger('requisition_quantity');
            $table->string('requisition_notes')->nullable();
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
        Schema::dropIfExists('requisitions');
    }
};
