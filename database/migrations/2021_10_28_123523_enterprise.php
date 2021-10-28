<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Enterprise extends Migration
{

    public function up()
    {
        Schema::create('enterprise', function (Blueprint $table){

            $table->id();
            $table->string('name');
            $table->bigInteger('phone');
            $table->string('address');
            $table->timestamps();
            $table->softDeletes();
        });

    }


    public function down()
    {
        Schema::dropIfExists('enterprise');
    }
}
