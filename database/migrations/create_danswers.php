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
            $table->string('Answer_Values');
            $table->string('Question_Id');
            $table->string('User_Id');
            $table->foreign('Question_Id')->references('Question_Id')->on('d_questions');
            $table->foreign('User_Id')->references('User_Id')->on('d_users');
            $table->primary(['Answer_Id', 'Question_Id', 'User_Id'], 'Session_Id_Question_Id_Answer_Id')
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
