<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('business_id');
            $table->foreign('business_id')->references('business_id')->on('businesses');
            $table->text('address1');
            $table->text('address2')->nullable();
            $table->text('address3')->nullable();
            $table->string('city');
            $table->string('zip_code');
            $table->string('country');
            $table->string('state');
            $table->double('latitude');
            $table->double('longitude');
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
        Schema::dropIfExists('locations');
    }
}
