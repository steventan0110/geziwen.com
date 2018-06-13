<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllowNullableInApplicantAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicant_awards', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->date('received_on')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicant_awards', function (Blueprint $table) {
            $table->text('description')->nullable(false)->change();
            $table->date('received_on')->nullable(false)->change();
        });
    }
}
