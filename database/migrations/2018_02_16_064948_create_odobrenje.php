<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOdobrenje extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odobrenja', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('odobren')->default(0);
            $table->integer('automobili_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('odobrenja', function($table) {
            $table->foreign('automobili_id')->references('id')->on('automobili');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('odobrenja');
    }
}
