<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * 'exam_type_id', 'init_exam_id' and 'final_exam_id' are for the language training facilities
     * That being said, if this applicant is not proposed by a language training facility,
     * all three fields should be null.
     *
     * exam_type_id = 1 -> IELTS; 2 -> TOEFL
     * Then, search table 'applicant_exam_ieltss' or 'applicant_exam_toefls' for the given exam id for further display.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->text('surname');
            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('exam_type_id')->nullable();
            $table->unsignedInteger('init_exam_id')->nullable();
            $table->unsignedInteger('final_exam_id')->nullable();
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
        Schema::dropIfExists('applicants');
    }
}
