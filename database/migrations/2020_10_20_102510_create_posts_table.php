<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('state_id')->unsigned()->index();
            $table->date('event_date');
            $table->time('event_time');
            $table->string('location', 100);
            $table->string('description');
            $table->text('note');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::table('posts', function(Blueprint $table) {
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
