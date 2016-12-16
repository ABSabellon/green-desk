<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReserveeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('middle_name', 100);
            $table->string('reservee_type', 20); //STUDENT/FULLTIME-PROF/PARTTIME-PROF/STAFF/OTHERS
            $table->string('professor_status', 20)->nullable();
            $table->string('professor_college', 10)->nullable();
            $table->string('professor_base', 10)->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('reservees');
    }
}
