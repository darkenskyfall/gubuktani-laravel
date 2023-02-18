<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->string('land')->nullable()->change();
            $table->string('road')->nullable()->change();
            $table->string('view')->nullable()->change();
            $table->integer('range')->nullable()->change();
            $table->string('height')->nullable()->change();
            $table->string('temperature')->nullable();
        });
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn(['temperature']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
