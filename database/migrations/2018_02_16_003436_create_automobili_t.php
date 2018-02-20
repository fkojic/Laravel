<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutomobiliT extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automobili', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ime');
            $table->integer('cena');
            $table->integer('godiste');
            $table->integer('km');
            $table->string('slika');
            $table->integer('user_id')->unsigned();
            $table->integer('kategorija_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('automobili', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('automobili', function($table) {
            $table->foreign('kategorija_id')->references('id')->on('kategorije');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('automobili');
    }
}
