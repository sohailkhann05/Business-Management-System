<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->char('business_id');
            $table->string('branch_title');
            $table->string('branch_banner')->nullable();
            $table->text('branch_address');
            $table->string('branch_phone_no');
            $table->string('branch_fax_no');
            $table->string('branch_email_address');
            $table->text('branch_secondary_address');
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
        Schema::dropIfExists('branches');
    }
}
