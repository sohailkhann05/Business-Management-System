<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('business_title');
            $table->text('business_address');
            $table->string('business_contact');
            $table->string('business_banner')->nullable();
            $table->string('business_logo')->nullable();
            $table->text('business_secondary_address');
            $table->string('business_website');
            $table->string('business_fax_no');
            $table->string('business_email_address');
            $table->string('business_phone_no');
            $table->string('business_details');
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
        Schema::dropIfExists('businesses');
    }
}
