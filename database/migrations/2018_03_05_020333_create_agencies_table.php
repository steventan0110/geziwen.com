<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * Column 'type' is used to differentiate language trainers and standardized tests trainers
     * 1 - Standardized tests; 2 - Language trainers
     *
     * 'thumbnail' has default 'null' instead of null because 'null' is naturally an invalid url
     * that would result in a blank placeholder.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type');
            $table->string('name');
            $table->string('introduction');
            $table->string('address');
            $table->string('telephone');
            $table->string('website');
            $table->date('started_on');
            $table->string('email');
            $table->string('thumbnail')->default('null');
            $table->timestamps();
        });

        Schema::create('agency_service_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('agency_id');
            $table->unsignedInteger('price');
            $table->string('name');
            $table->text('introduction');
            $table->timestamps();
        });

        Schema::create('agency_service_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('plan_id');
            $table->string('name');
            $table->text('introduction');
            $table->string('period');
            $table->timestamps();
        });

        Schema::create('agency_service_features', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('plan_id');
            $table->string('name');
            $table->text('introduction');
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
        Schema::dropIfExists('agencies');
        Schema::dropIfExists('agency_service_plans');
        Schema::dropIfExists('agency_service_steps');
        Schema::dropIfExists('agency_service_features');
    }
}
