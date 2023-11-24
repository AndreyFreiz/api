<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('name');
            $table->integer('displayOption');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
