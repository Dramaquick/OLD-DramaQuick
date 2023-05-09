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
        Schema::create('d_questions', function (Blueprint $table) {
            $table->id('Question_Id');
            $table->string('Question_Title');
            $table->string('Question_Description');
            $table->unsignedTinyInteger('Question_Type');
            $table->longText('Question_Options');
            $table->unsignedBigInteger('Session_Id');
            $table->foreign('Session_Id')->references('Session_Id')->on('d_sessions');
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
        Schema::dropIfExists('d_questions');
    }
};
