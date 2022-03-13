<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->boolean('visibility')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('topics', 'user_id'))
            Schema::table('topics', function (Blueprint $table) {$table->dropColumn('user_id');});
        if (Schema::hasColumn('topics', 'visibility'))
            Schema::table('topics', function (Blueprint $table) {$table->dropColumn('visibility');});
    }
}
