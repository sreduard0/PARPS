<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Reason extends Migration
{

      public function up()
    {
        Schema::create('reason', function (Blueprint $table){
            $table->id();
            $table->string('reason');
        });
    }


    public function down()
    {
        Schema::dropIfExists('reason');
    }

}
