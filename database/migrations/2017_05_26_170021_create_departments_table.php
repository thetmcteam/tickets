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
            $table->string('department');
            $table->string('color');
            $table->integer('public')->default(0);
            $table->integer('active')->default(1);

            $table->unique([
                'department', 
                'color'
            ]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
