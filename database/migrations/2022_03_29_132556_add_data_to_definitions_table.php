<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToDefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('definitions', function (Blueprint $table) {
            $table->boolean('flashable')->nullable();
            $table->boolean('mcquable')->nullable();
            $table->boolean('completable')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('definitions', 'flashable'))
            Schema::table('definitions', function (Blueprint $table) {$table->dropColumn('flashable');});
        if (Schema::hasColumn('definitions', 'mcquable'))
            Schema::table('definitions', function (Blueprint $table) {$table->dropColumn('mcquable');});
        if (Schema::hasColumn('definitions', 'completable'))
            Schema::table('definitions', function (Blueprint $table) {$table->dropColumn('completable');});
    }
}
