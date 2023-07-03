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
        Schema::create('users_verify', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('token');
            $table->timestamps();
        });
  
        // Already column exist in users table then skip this add new column
        // Schema::table('customers', function (Blueprint $table) {
        //     $table->boolean('email_verified_at')->default(0);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_verify');
        
        // Already column exist in users table then skip this add new column
        // Schema::table('customers', function (Blueprint $table) {
        //     if (Schema::hasColumn('customers', 'email_verified_at')) {
        //         $table->dropColumn('email_verified_at');
        //     }
        // });
    }
};
