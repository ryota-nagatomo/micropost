<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMicropostUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('micropost_user', function (Blueprint $table) {
            $table->increments('id'); //favorite_id
            $table->timestamps();
            
            $table->integer('favo_user_id')->unsigned()->index(); //お気に入りした人のid
            $table->integer('post_id')->unsigned()->index(); //投稿自体のid

            // Foreign key setting
            $table->foreign('favo_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('microposts')->onDelete('cascade');
            
            $table->unique(['favo_user_id', 'post_id']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('micropost_user');
    }
}
