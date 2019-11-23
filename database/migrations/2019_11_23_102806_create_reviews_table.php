<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('review_id')->unique();
            $table->string('business_id');
            $table->foreign('business_id')->references('business_id')->on('businesses');
            // $table->string('api_user_id');
            // $table->foreign('api_user_id')->references('api_user_id')->on('user_reviews');
            $table->unsignedBigInteger('user_review_id');
            $table->foreign('user_review_id')->references('id')->on('user_reviews');
            $table->longText('url');
            $table->longText('text');
            $table->integer('rating');
            $table->date('time_created');
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
        Schema::dropIfExists('reviews');
    }
}
