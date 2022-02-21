<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GithubUsersRepositories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('github_users_repositories', function (Blueprint $table) {
            $table->bigInteger('github_user_id')
                  ->index();
            $table->bigInteger('github_repository_id')
                  ->index()
                  ->unique();
            $table->string('name', 64)->nullable();
            $table->text('description')->nullable();
            $table->boolean('fork');
            $table->string('url', 256);
            $table->timestamps();

            $table->foreign('github_user_id')
                ->references('github_user_id')
                ->on('github_users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('github_users_repositories');
    }
}
