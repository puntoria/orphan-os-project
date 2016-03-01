<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrphansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orphans', function (Blueprint $table) {
            $table->increments('id');

            // First Name
            $table->string('first_name');
            $table->string('first_name_ar');

            // Middle Name
            $table->string('middle_name');
            $table->string('middle_name_ar');

            // Last name
            $table->string('last_name');
            $table->string('last_name_ar');

            $table->boolean('gender')->default(0); # 0 => Male, 1 => Female
            $table->date('birthday');

            $table->string('phone');
            $table->string('email');
            $table->string('national_id');
            $table->string('bank_id');
            $table->string('photo');
            $table->string('video');

            $table->boolean('health_state')->default(1); # 0 => Bad, 1 => Good
            $table->boolean('has_donation')->default(0);

            $table->integer('donor_id')->unsigned()->nullable();
            $table->foreign('donor_id')->references('id')->on('users')->onUpdate('cascade');
            
            $table->text('note');

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
        Schema::drop('orphans');
    }
}