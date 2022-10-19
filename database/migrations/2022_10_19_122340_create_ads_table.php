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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_category');
            $table->string('title');
            $table->string('address');
            $table->string('large');
            $table->string('certification');
            $table->string('desc');
            $table->integer('price');
            $table->string('period');
            $table->integer('status'); // 0 tersedia, 1 tersewa
            $table->string('condition');
            $table->string('irigation');
            $table->string('land');
            $table->string('road');
            $table->string('view');
            $table->string('picture_one');
            $table->string('picture_two');
            $table->string('picture_three');
            $table->string('picture_four');
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
        Schema::dropIfExists('ads');
    }
};
