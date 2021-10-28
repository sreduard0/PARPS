<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Visitors extends Migration
{

    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->bigInteger('cpf');
            $table->bigInteger('phone');
            $table->tinyInteger('cnh');
            $table->integer('enterprise');
            $table->text('photo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
