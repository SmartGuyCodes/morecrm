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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->string('item_qr_code')->nullable();
            $table->string('item_name');
            $table->string('item_image');
            $table->string('item_type');
            $table->string('item_location');

            $table->integer('item_supplier_id');
            $table->integer('item_category_id');

            $table->bigInteger('item_quantity');
            $table->bigInteger('item_reorder_level');

            $table->integer('item_buying_price');
            $table->integer('item_selling_price');

            $table->boolean('item_catering_levy')->default(false);
            $table->boolean('item_vat')->default(false);
            $table->boolean('item_excise_duty')->default(false);

            $table->string('item_package_type');
            $table->string('item_batch_no');
            $table->timestamp('item_expiry_date');
            $table->string('item_description')->nullable();
            // $table->string('');
            // $table->string('');
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
        Schema::dropIfExists('items');
    }
};
