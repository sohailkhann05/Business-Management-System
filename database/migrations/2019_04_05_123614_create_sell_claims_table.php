<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_claims', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->char('branch_id');
            $table->char('user_id')->nullable();
            $table->char('customer_id')->nullable();
            $table->char('sell_order_id');
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
        Schema::dropIfExists('sell_claims');
    }
}
