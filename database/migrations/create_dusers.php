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
        Schema::create('d_users', function (Blueprint $table) {
            $table->id('User_Id');
            $table->string('User_Name');
            $table->string('User_Email');
            $table->string('User_Password');
            $table->rememberToken('User_RememberToken');
            $table->string('User_Role');
            $table->string('User_EmailVerifiedAt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_users');
    }
};
