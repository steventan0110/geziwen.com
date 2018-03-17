<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_universities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('country');
            $table->string('website');
            $table->timestamps();
        });

        Schema::create('admission_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('shorthand');
            $table->timestamps();
        });

        Schema::create('admission_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('applicant_id');
            $table->unsignedInteger('university_id');
            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('decision_id');
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
        Schema::dropIfExists('admission_universities');
        Schema::dropIfExists('admission_plans');
        Schema::dropIfExists('admission_decisions');
        Schema::dropIfExists('admission_applications');
        Schema::dropIfExists('universities');
        Schema::dropIfExists('plans');
        Schema::dropIfExists('decisions');
        Schema::dropIfExists('applications');
    }
}
