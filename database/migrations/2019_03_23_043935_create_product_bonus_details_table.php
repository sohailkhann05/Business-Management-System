<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductBonusDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_bonus_details', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->char('product_bonus_id');
            $table->char('product_id');
            $table->bigInteger('total_sales')->nullable();
            $table->bigInteger('total_amount')->nullable();
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
        Schema::dropIfExists('product_bonus_details');
    }
}
