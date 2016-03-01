<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family', function (Blueprint $table) {
            $table->increments('id');

            $table->string('caretaker_name');
            $table->string('caretaker_relation');

            $table->integer('family_members')->nullable();
            $table->integer('brothers')->nullable();
            $table->integer('sisters')->nullable();

            $table->boolean('no_parents')->default(0);
            $table->date('parent_death')->nullable();

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
        Schema::drop('family');
    }
}
