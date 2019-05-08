<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createtablepageslikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pages_Likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id');
            $table->integer('owner_id');
            $table->integer('like');
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
        Schema::table('PagesLikes', function (Blueprint $table) {
            //
        });
    }
}
