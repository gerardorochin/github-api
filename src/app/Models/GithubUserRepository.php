<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GithubUserRepository extends Model
{
    protected $table = 'github_users_repositories';
    protected $primaryKey = 'github_repository_id';
    protected $fillable = [
        'github_user_id',
        'github_repository_id',
        'name',
        'description',
        'fork',
        'url',
    ];
}

