<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('definitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('chapter_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title')->nullable();
            $table->boolean('reversible')->default(1)->nullable();
            $table->boolean('automcquable')->default(1)->nullable();
            $table->boolean('custommcquable')->default(0)->nullable();
            $table->longText('explanation')->nullable();
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
        Schema::dropIfExists('definitions');
    }
}
