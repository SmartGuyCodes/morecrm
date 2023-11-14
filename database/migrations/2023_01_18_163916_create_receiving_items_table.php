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
        Schema::create('receiving_items', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->bigInteger("uuid");
            $table->string('grn_no');
            $table->integer('item_id');
            $table->string('item_name');
            $table->bigInteger('item_price')->default(0);
            $table->integer('item_discount')->default(0);
            $table->integer('item_qty');
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
        Schema::dropIfExists('receiving_items');
    }
};
