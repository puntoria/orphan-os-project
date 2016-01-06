<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTable extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->increments('id');

            $table->string('level')->nullable();
            $table->integer('class')->unsigned()->nullable();
            $table->string('grades')->nullable();
            $table->boolean('with_pay')->default(0);

            $table->integer('orphan_id')->unsigned();
            $table->foreign('orphan_id')->references('id')->on('orphans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('education');
    }
}
