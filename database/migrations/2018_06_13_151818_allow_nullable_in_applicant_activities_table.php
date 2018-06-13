<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllowNullableInApplicantActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicant_activities', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->date('start')->nullable()->change();
            $table->date('end')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicant_activities', function (Blueprint $table) {
            $table->text('description')->nullable(false)->change();
            $table->date('start')->nullable(false)->change();
            $table->date('end')->nullable(false)->change();
        });
    }
}
