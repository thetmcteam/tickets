<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitesTable extends Migration
{
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->string('email');
            $table->integer('admin')->default(0);
            $table->datetime('expires_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invites');
    }
}
