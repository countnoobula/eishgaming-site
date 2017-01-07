<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialIdsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('facebook_id')->nullable();
            $table->string('steam_id')->nullable();
            $table->string('steam_community_id')->nullable();
            
            $table->index('facebook_id');
            $table->index('steam_id');
            $table->index('steam_community_id');
            
            $table->unique('facebook_id');
            $table->unique('steam_id');
            $table->unique('steam_community_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
