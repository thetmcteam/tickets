<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorizationsTable extends Migration
{
    public function up()
    {
        Schema::create('authorizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user');
            $table->integer('department');

            $table->unique([
                'user', 
                'department'
            ]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('authorizations');
    }
}
