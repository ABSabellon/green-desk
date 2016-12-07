<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservee_id')->unsigned();
            $table->integer('room_id')->unsigned()->nullable();
            $table->integer('exam_id')->unsigned()->nullable();
            $table->string('name', 100)->nullable();
            // $table->string('description', 500);
            $table->date('date')->nullable();
            $table->time('time_start')->nullable();
            $table->time('time_end')->nullable();
            $table->string('status', 10)->nullable(); //create table?
            // $table->boolean('archived')->default(false); //create table?
            $table->timestamps();
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->foreign('reservee_id')->references('id')->on('reservees');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('exam_id')->references('id')->on('exams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
