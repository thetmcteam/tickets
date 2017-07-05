<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrioritiesTable extends Migration
{
    public function up()
    {
        Schema::create('priorities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('priority')->unique();
            $table->string('color')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('priorities');
    }
}
