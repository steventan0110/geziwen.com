<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('applicant_id');
            $table->unsignedInteger('type_id');
            $table->text('name');
            $table->text('description');
            $table->date('start');
            $table->date('end');
            $table->unsignedInteger('hours_per_week');
            $table->timestamps();
        });

        Schema::create('applicant_activity_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicant_activities');
        Schema::dropIfExists('applicant_activity_types');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('activity_types');
    }
}
