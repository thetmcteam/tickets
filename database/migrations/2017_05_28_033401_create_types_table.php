<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('color');

            $table->unique([
                'type',
                'color'
            ]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('types');
    }
}
