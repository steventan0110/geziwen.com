<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllowNullToAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agencies', function (Blueprint $table) {
            $table->string('introduction')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('telephone')->nullable()->change();
            $table->string('website')->nullable()->change();
            $table->date('started_on')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agencies', function (Blueprint $table) {
            $table->string('introduction')->change();
            $table->string('address')->change();
            $table->string('telephone')->change();
            $table->string('website')->change();
            $table->date('started_on')->change();
        });
    }
}
