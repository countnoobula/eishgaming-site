<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('tag');
            $table->enum('tag_position', ['PREPEND', 'APPEND'])->default('PREPEND');
            $table->date('established');
            $table->string('avatar_url')->nullable();
            $table->index(['tag']);
            $table->timestamps();
        });
        
        Schema::create('clan_user', function (Blueprint $table) {
            $table->integer('clan_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('role')->default('member');
            $table->index(['clan_id', 'user_id',]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clans');
        Schema::drop('clan_user');
    }
}
