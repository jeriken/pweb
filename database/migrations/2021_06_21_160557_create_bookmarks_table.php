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
                $table->id('book_id');
                $table->bigInteger('pict_id')->unsigned();
                $table->bigInteger('user_id')->unsigned();
                $table->timestamps();
            });
        }
        
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->foreign('pict_id')->references('pict_id')->on('pictures')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
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
