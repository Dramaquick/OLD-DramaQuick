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
        Schema::create('d_session_tags_links', function (Blueprint $table) {
            $table->unsignedBigInteger('Session_Id');
            $table->unsignedBigInteger('Tag_Id');
            $table->foreign('Session_Id')->references('Session_Id')->on('d_sessions');
            $table->foreign('Tag_Id')->references('Tag_Id')->on('d_session_tags');
            $table->primary(['Session_Id', 'Tag_Id']);
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
        Schema::dropIfExists('d_session_tags_links');
    }
};
