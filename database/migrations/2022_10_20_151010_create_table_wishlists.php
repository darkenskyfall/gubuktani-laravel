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
        Schema::table('ads', function (Blueprint $table) {
            $table->string('irigation')->nullable();
            $table->string('land')->nullable();
            $table->string('road')->nullable();
            $table->string('view')->nullable();
            $table->string('range')->nullable();
            $table->string('temperature')->nullable();
            $table->string('height')->nullable();
            $table->string('notice')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
};
