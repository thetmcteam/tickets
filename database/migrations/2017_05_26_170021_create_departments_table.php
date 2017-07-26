<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('department')->unique();
            $table->string('color')->unique();
            $table->integer('public')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
