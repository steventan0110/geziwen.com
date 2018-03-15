<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgencyRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("rating");
            $table->unsignedInteger('agency_id');
            $table->timestamps();

            // Create foreign key
            $table->foreign('agency_id')
                ->references('id')
                ->on('agencies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agency_ratings');
    }
}
