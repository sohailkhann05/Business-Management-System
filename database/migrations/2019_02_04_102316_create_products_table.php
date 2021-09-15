<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->char('product_category_id');
            $table->char('branch_id');
            $table->string('product_name');
            $table->double('product_initial_price');
            $table->double('product_purchased_price');
            $table->double('product_average_price');
            $table->string('product_selling_unit');
            $table->string('product_purchased_unit');
            $table->double('product_unit_quantity');
            $table->text('description');
            $table->string('product_image');
            $table->integer('bonus_check')->default(0);
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
        Schema::dropIfExists('products');
    }
}
