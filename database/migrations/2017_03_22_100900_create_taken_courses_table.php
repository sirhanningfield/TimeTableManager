<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTakenCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taken_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coursecode');
            $table->string('name');
            $table->integer('credits');
            $table->integer('classes');
            $table->integer('start_time');
            $table->integer('end_time');
            $table->string('days');
            $table->string('status');
            $table->integer('user_id');
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
        Schema::dropIfExists('taken_courses');
    }
}
