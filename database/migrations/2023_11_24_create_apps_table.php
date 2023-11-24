<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('partnerLinkText')->nullable();
            $table->string('partnerLinkUrl')->nullable();
            $table->string('partnerId');
            $table->string('icon');
            $table->text('screenshots')->nullable();
            $table->text('content');
            $table->integer('size')->nullable();
            $table->date('publicationDate')->nullable();
            $table->string('categoryId');
            $table->string('version')->nullable();
            $table->string('solutionId')->nullable();
            $table->string('language')->nullable();
            $table->string('policyLink')->nullable();
            $table->string('licenseLink')->nullable();
            $table->integer('displayOption');
        });
    }

    public function down()
    {
        Schema::dropIfExists('apps');
    }
};
