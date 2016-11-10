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
        Schema::create('reservation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservee_id')->unsigned();
            $table->foreign('reservee_id')->references('id')->on('reservee');
            $table->integer('room_id')->unsigned();
            $table->foreign('room_id')->references('id')->on('room');
            $table->string('name', 100);
            $table->string('description', 500);
            $table->date('date');
            $table->time('time_start');
            $table->time('time_end');
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('event');
            $table->string('status', 10); //create table?
            $table->boolean('archived')->default(false); //create table?
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
        Schema::dropIfExists('reservation');
    }
}
