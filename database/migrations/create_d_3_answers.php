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
            $table->unsignedBigInteger('Answer_Id');
            $table->string('Answer_Values');
            $table->unsignedBigInteger('Question_Id'); // Composite foregin key
            $table->unsignedBigInteger('Session_Id'); // Composite foregin key
            $table->unsignedBigInteger('User_Id');
            $table->foreign(['Question_Id', 'Session_Id'])->references(['Question_Id', 'Session_Id'])->on('d_questions');
            $table->foreign('User_Id')->references('id')->on('d_users');
            $table->primary(['Answer_Id', 'Question_Id', 'User_Id']);
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
