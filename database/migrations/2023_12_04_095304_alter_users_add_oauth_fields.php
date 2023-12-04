<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersAddOauthFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('oauth_provider', ['google', 'facebook', 'twitter', 'linkedin'])->nullable()->after('profile_image');
            $table->string("oauth_uid", 255)->nullable()->after("oauth_provider");
            $table->string("avatar", 255)->nullable()->after("oauth_uid");
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
            $table->dropColumn('oauth_provider');
            $table->dropColumn('oauth_uid');
            $table->dropColumn('avatar');
        });
    }
}
