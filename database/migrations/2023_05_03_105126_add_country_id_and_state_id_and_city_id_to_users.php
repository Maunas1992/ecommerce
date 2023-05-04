<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryIdAndStateIdAndCityIdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedbigInteger('country_id')->nullable()->after('mobile_no');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->unsignedbigInteger('state_id')->nullable()->after('country_id');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->unsignedbigInteger('city_id')->nullable()->after('state_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
