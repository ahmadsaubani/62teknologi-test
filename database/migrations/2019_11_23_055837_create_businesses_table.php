<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('business_id')->unique();
            $table->string('alias');
            $table->string('name');
            $table->longText('image_url');
            $table->boolean('is_closed')->default(false);
            $table->longText('url');
            $table->float('rating', 3, 1);
            $table->longText('transactions')->nullable();
            $table->longText('categories')->nullable();
            $table->string('price')->nullable();
            $table->string('phone')->nullable();
            $table->string('display_phone');
            
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
        Schema::dropIfExists('businesses');
    }
}
