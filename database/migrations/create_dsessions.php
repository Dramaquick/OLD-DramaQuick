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
        Schema::create('d_sessions', function (Blueprint $table) {
            $table->id('Session_Id');
            $table->string('Session_Title');
            $table->string('Session_Description');
            $table->unsignedBigInteger('Session_MinUser');
            $table->unsignedBigInteger('Session_MaxUser');
            $table->unsignedBigInteger('Session_Speed');
            $table->string('Owner_Id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_sessions');
    }
};
