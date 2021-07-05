<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('bookmarks')){
            Schema::create('bookmarks', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('picture_id')->unsigned();
                $table->bigInteger('user_id')->unsigned();
                $table->timestamps();
            });
        }
        
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->foreign('picture_id')->references('id')->on('pictures');
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
        Schema::dropIfExists('bookmarks');
    }
}
