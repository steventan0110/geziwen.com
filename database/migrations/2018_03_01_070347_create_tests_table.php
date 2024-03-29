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
        Schema::create('applicant_exam_toefls', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('applicant_id');
            $table->date('taken_on');
            $table->unsignedInteger('reading');
            $table->unsignedInteger('listening');
            $table->unsignedInteger('speaking');
            $table->unsignedInteger('writing');
            $table->timestamps();
        });

        Schema::create('applicant_exam_ieltss', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('applicant_id');
            $table->date('taken_on');
            $table->unsignedInteger('reading');
            $table->unsignedInteger('listening');
            $table->unsignedInteger('speaking');
            $table->unsignedInteger('writing');
            $table->timestamps();
        });

        Schema::create('applicant_exam_sats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('applicant_id');
            $table->date('taken_on');
            $table->unsignedInteger('reading');
            $table->unsignedInteger('math');
            $table->unsignedInteger('writing');
            $table->unsignedInteger('essay');
            $table->timestamps();
        });

        Schema::create('applicant_exam_sat_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('applicant_id');
            $table->date('taken_on');
            $table->string('subject');
            $table->unsignedInteger('score');
            $table->timestamps();
        });

        Schema::create('applicant_exam_aps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('applicant_id');
            $table->date('taken_on');
            $table->string('subject');
            $table->unsignedInteger('score');
            $table->timestamps();
        });

        Schema::create('applicant_exam_acts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('applicant_id');
            $table->unsignedInteger('reading');
            $table->unsignedInteger('english');
            $table->unsignedInteger('math');
            $table->unsignedInteger('science');
            $table->date('taken_on');
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
        Schema::dropIfExists('toefls');
        Schema::dropIfExists('ieltss');
        Schema::dropIfExists('sat_subjects');
        Schema::dropIfExists('sats');
        Schema::dropIfExists('aps');
        Schema::dropIfExists('acts');
        Schema::dropIfExists('applicant_exam_toefls');
        Schema::dropIfExists('applicant_exam_ieltss');
        Schema::dropIfExists('applicant_exam_sat_subjects');
        Schema::dropIfExists('applicant_exam_sats');
        Schema::dropIfExists('applicant_exam_aps');
        Schema::dropIfExists('applicant_exam_acts');
    }
}
