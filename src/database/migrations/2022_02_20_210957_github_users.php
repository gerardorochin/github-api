<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GithubUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('github_users', function (Blueprint $table) {
            $table->bigInteger('github_user_id')
                  ->index()
                  ->unique();
            $table->string('login', 64)
                  ->index()
                  ->unique();
            $table->string('name', 64);
            $table->string('email', 256);
            $table->string('url', 256);
            $table->string('avatar_url', 256);
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
        Schema::dropIfExists('github_users');
    }
}
