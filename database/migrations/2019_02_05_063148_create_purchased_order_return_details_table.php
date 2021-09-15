<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasedOrderReturnDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchased_order_return_details', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->char('purchased_order_return_id');
            $table->char('product_id');
            $table->string('return_unit');
            $table->double('return_quantity');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('purchased_order_return_details');
    }
}
