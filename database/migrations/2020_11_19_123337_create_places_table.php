<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('image')->nullable();
            $table->longText('description_en')->nullable()->default('text');
            $table->longText('description_ar')->nullable()->default('text');
            $table->string('phone')->nullable();
            $table->integer('subCategory_id')->unsigned();
            $table->foreign('subCategory_id')->references('id')->on('subCategory')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('area')->onDelete('cascade')->onUpdate('cascade');
            $table->string('Longitude')->nullable();
            $table->string('Latitude')->nullable();
            $table->string('Facebook')->nullable();
            $table->string('Twitter')->nullable();
            $table->integer('popular_section')->nullable()->default(0); // 0=> not appear.... 1=> appear
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('places');
    }
}
