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
        Schema::create('d_session_tags', function (Blueprint $table) {
            $table->id('Tag_Id');
            $table->string('Tag_Name');
            $table->string('Tag_Emoji');
            $table->string('Tag_Color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_session_tags');
    }
};
