<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Records extends Migration
{

    public function up()
    {
        Schema::create('records', function (Blueprint $table){
            $table->id();
            $table->integer('visitor_id');
            $table->integer('drive');
            $table->integer('destination_id');
            $table->string('reason');
            $table->integer('badge');
            $table->integer('enterprise_id');
            $table->datetime('date_entrance');
            $table->string('registred_by');
            $table->datetime('date_exit')->nullable();
            $table->string('finished_by')->nullable();
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('records');
    }
}
