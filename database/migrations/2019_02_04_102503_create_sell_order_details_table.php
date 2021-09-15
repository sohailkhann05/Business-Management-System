<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_order_details', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->char('product_id');
            $table->char('sell_order_id');
            $table->char('user_id')->nullable();
            $table->double('per_product_price');
            $table->string('sell_unit');
            $table->string('quantity');
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
        Schema::dropIfExists('sell_order_details');
    }
}
