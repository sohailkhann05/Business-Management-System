<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_admins', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->char('business_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('hint');
            $table->rememberToken();
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
        Schema::dropIfExists('business_admins');
    }
}
