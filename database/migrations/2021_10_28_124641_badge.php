<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Badge extends Migration
{
      public function up()
    {
        Schema::create('badge', function (Blueprint $table){
            $table->id();
            $table->integer('badge');
            $table->string('color')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('badge');
    }
}
