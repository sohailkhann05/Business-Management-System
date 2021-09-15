<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashAccountDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_account_details', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->char('cash_account_id');
            $table->text('cash_description');
            $table->double('transfer_amount');
            $table->string('transfer_type');
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
        Schema::dropIfExists('cash_account_details');
    }
}
