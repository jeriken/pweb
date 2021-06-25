<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('pictures')){
            Schema::create('pictures', function (Blueprint $table) {
                $table->id('pict_id');
                $table->string('title');
                $table->string('caption');
                $table->string('pict_url');
                $table->bigInteger('cat_id')->unsigned();
                $table->bigInteger('user_id')->unsigned();
                $table->timestamps();
            });
        }


        Schema::table('pictures', function (Blueprint $table) {
            $table->foreign('cat_id')->references('cat_id')->on('categories')
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
        Schema::dropIfExists('pictures');
    }
}
