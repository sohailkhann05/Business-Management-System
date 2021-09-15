<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_orders', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->char('branch_id');
            $table->char('user_id')->nullable();
            $table->char('customer_id')->nullable();
            $table->string('invoice_no')->nullable()->unique();
            $table->string('belty_no')->nullable();
            $table->string('received_by')->nullable();
            $table->double('discount_amount')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->nullable();
            $table->double('total_amount')->nullable();
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
        Schema::dropIfExists('sell_orders');
    }
}
