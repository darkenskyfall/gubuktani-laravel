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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ads');
            $table->string('land');
            $table->string('road');
            $table->string('view');
            $table->integer('range');
            $table->string('height');
            $table->timestamps();
        });

        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn(['land', 'road', 'view', 'range', 'height']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facilities', function (Blueprint $table) {
            //
        });
    }
};
