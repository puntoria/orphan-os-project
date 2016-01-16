<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('year');
            $table->integer('month')->nullable();
            $table->boolean('has_donation')->default(0);

            $table->string('amount_euro')->nullable();
            $table->string('amount_dinar')->nullable();

            $table->string('type')->nullable();
            $table->date('received_at')->nullable();

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
        Schema::drop('finances');
    }
}
