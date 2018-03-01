<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('toefl', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student');
            $table->date('taken_on');
            $table->unsignedInteger('reading');
            $table->unsignedInteger('listening');
            $table->unsignedInteger('speaking');
            $table->unsignedInteger('writing');
            $table->timestamps();
        });

        Schema::create('ielts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student');
            $table->date('taken_on');
            $table->unsignedInteger('reading');
            $table->unsignedInteger('listening');
            $table->unsignedInteger('speaking');
            $table->unsignedInteger('writing');
            $table->timestamps();
        });

        Schema::create('sat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student');
            $table->date('taken_on');
            $table->unsignedInteger('reading');
            $table->unsignedInteger('math');
            $table->unsignedInteger('essay');
            $table->timestamps();
        });

        Schema::create('sat_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student');
            $table->date('taken_on');
            $table->string('subject');
            $table->unsignedInteger('score');
            $table->timestamps();
        });

        Schema::create('ap', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student');
            $table->date('taken_on');
            $table->string('subject');
            $table->unsignedInteger('score');
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
        Schema::dropIfExists('toefl');
        Schema::dropIfExists('ielts');
        Schema::dropIfExists('sat_subject');
        Schema::dropIfExists('sat');
        Schema::dropIfExists('ap');
    }
}
