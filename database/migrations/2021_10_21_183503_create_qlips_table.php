<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlips', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->integer('content_size');
            $table->integer('question_id');
            $table->integer('advisor_id');
            $table->string('youtube')->nullable();
            $table->integer('upvote');
            $table->integer('listing');
            $table->integer('status_id');
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
        Schema::dropIfExists('qlips');
    }
}
