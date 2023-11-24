<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('name');
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('link')->nullable();
            $table->integer('displayOption');
        });
    }

    public function down()
    {
        Schema::dropIfExists('partners');
    }
};
