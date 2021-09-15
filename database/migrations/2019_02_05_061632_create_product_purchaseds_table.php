<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPurchasedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_purchaseds', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->char('purchased_order_id');
            $table->char('product_id');
            $table->double('per_product_price');
            $table->double('product_purchased_quantity');
            $table->string('product_purchased_unit');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('product_purchaseds');
    }
}
