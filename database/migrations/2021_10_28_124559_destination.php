<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Destination extends Migration
{

    public function up()
    {
        Schema::create('destination', function (Blueprint $table){
            $table->id();
            $table->string('destination');
            $table->string('color');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('destination');
    }
}
