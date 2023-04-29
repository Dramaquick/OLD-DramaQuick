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
        Schema::create('d_answers', function (Blueprint $table) {
            $table->id('Answer_Id');
            $table->string('Answer_Values')->nullable();
            $table->unsignedBigInteger('Question_Id'); // Composite foregin key
            $table->unsignedBigInteger('Session_Id'); // Composite foregin key
            $table->unsignedBigInteger('User_Id');
            $table->foreign('Question_Id')->references('Question_Id')->on('d_questions');
            $table->foreign('Session_Id')->references('Session_Id')->on('d_sessions');
            $table->foreign('User_Id')->references('id')->on('d_users');
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
        Schema::dropIfExists('d_answers');
    }
};
