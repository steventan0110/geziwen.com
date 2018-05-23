<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToAdmissionUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admission_universities', function (Blueprint $table) {
            $table->renameColumn('country', 'location');
            $table->renameColumn('website', 'introduction');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admission_universities', function (Blueprint $table) {
            $table->renameColumn('location', 'country');
            $table->renameColumn('introduction', 'website');
        });
    }
}
